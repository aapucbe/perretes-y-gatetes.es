<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PerfilForm;
use app\models\Usuarios;
use app\models\Mascotas;
use app\models\Imagenes;
use app\models\Albumes;
use app\models\CrearmascotaForm;
use app\models\PerfilmascotaForm;
use app\models\SubirimagenForm;
use app\models\CrearalbumForm;
use app\models\BuscarmascotasForm;
use app\models\Amigos;
use app\models\Peticiones;
use app\models\EnviarmsjForm;
use app\models\Mensajes;
use app\models\Posts;
use app\models\CrearpostForm;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\data\Pagination;

class MascotasController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'layout_mascotas';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->redirect(['mascotas/vermuro']);
    }

    public function actionPerfil(){

        $model = new PerfilmascotaForm;
        $msg = null;

        # Parametros recibidos por POST al actualizar el formulario
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate()){

                $mascota = Mascotas::findOne($model->id);
                # Comprobamos que exista ese mascota
                if($mascota){

                    $model->foto_perfil = UploadedFile::getInstance($model, 'foto_perfil');
                    if($model->foto_perfil){
                        $model->upload_perfil();
                        $mascota->foto_perfil = 'foto_perfil.'.$model->foto_perfil->extension;
                        $mascota->foto_perfil_mod = 1;                       
                    }

                    $model->foto_cabecera = UploadedFile::getInstance($model, 'foto_cabecera');
                    if($model->foto_cabecera){
                        $model->upload_cabecera();
                        $mascota->foto_cabecera = 'foto_cabecera.'.$model->foto_cabecera->extension;
                        $mascota->foto_cabecera_mod = 1;                        
                    }

                    $mascota->nombre = $model->nombre;
                    $mascota->raza = $model->raza;
                    $mascota->hogar = $model->hogar;
                    $mascota->fecha_nacimiento = $model->fecha_nacimiento;
                    $mascota->descripcion = $model->descripcion;                  

                    if ($mascota->update())
                    {
                        $msg = "Sus datos han sido actualizados correctamente";
                    }else
                    {
                        $msg = "Sus datos han sido actualizados correctamente";
                    }
                }
            }
        }

        # Al acceder por GET
        if (Yii::$app->request->get()){

            # Obtenemos el id de la mascota actual
            $id = $this->getId();
            $id_usuario = Yii::$app->user->identity->id;
            $email_usuario = Yii::$app->user->identity->email;

            # Guardamos los datos para insertarlos en el formulario al modo de placeholders
            $mascota = Mascotas::findOne($id);
            # Comprobamos que exista ese id
            if($mascota)
            {
                $model->id = $mascota->id;
                $model->id_usuario = $id_usuario;
                $model->email_usuario = $email_usuario;
                $model->nombre = $mascota->nombre;
                $model->raza = $mascota->raza;
                $model->hogar = $mascota->hogar;
                $model->fecha_nacimiento = $mascota->fecha_nacimiento;
                $model->descripcion = $mascota->descripcion;                
            }

        }        

        return $this->render('perfil',['model' => $model, 'msg' => $msg]);
    }

    # Obtenemos el id de la mascota actual
    public function getId(){
        $session = Yii::$app->session;
        $session->open();
        $id_mascota = $session['id_mascota'];
        $session->close();
        return $id_mascota;
    }

    public function actionImagenes(){

        $model = new SubirimagenForm();
        $msg = '';
        $id_amigo = '';

        # Parametros recibidos por POST mediante el formulario
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $imagen = new Imagenes();

                if ($model->imagen = UploadedFile::getInstance($model, 'imagen')) {
                    $imagen->id_mascota = $model->id_mascota;
                    $imagen->id_album = $model->id_album;

                    $imagen->save();

                    $model->upload_imagen($imagen->id);
                    $imagen->nombre = ''.$imagen->id.'-'.$model->imagen->name;

                    $imagen->save();

                    $msg = 'Su imágen se ha subido con exito';
                }else{
                    $msg = 'Seleccione una imagen para subir';
                }
                
            }        

        }

        # Comprobamos si se esta accediendo para ver el perfil del amigo a nuestras imágenes
        if (Yii::$app->request->get('id_amigo'))
        {
            $id_amigo = $_GET['id_amigo'];
            $query = Imagenes::find()->where(['id_mascota' => $id_amigo, 'id_album' => 0]);
        }else
        {
            $query = Imagenes::find()->where(['id_mascota' => $this->getId(), 'id_album' => 0]);
        }        

        $countQuery = clone $query;
        $pages = new Pagination([
            'pageSize' => 9,
            'totalCount' => $countQuery->count(),            
        ]);
        $imagenes = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        # Al acceder por GET inicializaremos las variables id_mascota e id_album
        if (Yii::$app->request->get()){
            $model->id_mascota = $this->getId();
            $model->id_album = 0;

        }

        return $this->render('imagenes',['model' => $model,'msg' => $msg, 'imagenes' => $imagenes, 'pages' => $pages,'id_amigo' => $id_amigo]);
    }

    public function actionEliminarimagen(){
        if (Yii::$app->request->post()){
            $id_imagen = $_POST['id_imagen'];
            $id_album = $_POST['id_album'];
            $imagen = Imagenes::findOne($id_imagen);
            if ($id_album == 0) {
                # Eliminamos el archivo
                unlink(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$imagen->id_mascota.'/imagenes/'.$imagen->nombre);
                # Eliminamos de la base de datos
                $imagen->delete();
                # Redirigimos a la vista anterior
                $this->redirect(["mascotas/imagenes"]);
            }else{
                # Eliminamos el archivo
                unlink(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$imagen->id_mascota.'/albumes/album-'.$id_album.'/'.$imagen->nombre);
                # Eliminamos de la base de datos
                $imagen->delete();
                # Redirigimos a la vista anterior
                $this->redirect(["mascotas/accederalbum",'id_album' => $id_album]);
            }
            

        }
    }

    public function actionAlbumes(){

        $id_amigos = '';

        # Comprobamos si se esta accediendo para ver el perfil del amigo a nuestras imágenes
        if (Yii::$app->request->get('id_amigo'))
        {
            $id_amigo = $_GET['id_amigo'];
            $query = Albumes::find()->where(['id_mascota' => $id_amigo]);
        }else
        {
            $query = Albumes::find()->where(['id_mascota' => $this->getId()]);
        }
        
        $countQuery = clone $query;
        $pages = new Pagination([
            'pageSize' => 9,
            'totalCount' => $countQuery->count(),            
        ]);
        $albumes = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('albumes',['pages' => $pages, 'albumes' => $albumes,'id_amigo' => $id_amigo]);
    }

    public function actionCrearalbum(){
        $msg = '';
        $model = new CrearalbumForm();
        $mascota_id = $this->getId();

        # Al acceder por GET inicializaremos la variable id_mascota
        if (Yii::$app->request->get()){
            $model->id_mascota = $this->getId();
        }

        # Parametros recibidos por POST mediante el formulario
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $album = new Albumes();
                $album->id_mascota = $model->id_mascota;
                $album->nombre = $model->nombre;
                $album->imagen_destacada = 'imagen_destacada.jpg';
                $album->save();

                /**
                 * Creacion de las carpetas necesarias para los albumes
                 */
                $dir = Yii::$app->params['urlBaseImg'].'/mascotas/mascota-'.$mascota_id.'/albumes/album-'.$album->id;
                mkdir($dir, 0777, true);

                $this->redirect(["mascotas/albumes"]);
            }
        }

        return $this->render('crearalbum',['model' => $model]);
    }

    public function actionAccederalbum(){

            $id_amigo = '';

             # Comprobamos si se esta accediendo para ver el perfil del amigo a nuestras imágenes
            if (Yii::$app->request->get('id_amigo'))
            {
                $id_amigo = $_GET['id_amigo'];
            }

            # Obtenemos el id del álbum enviado por GET
            $id_album = $_GET['id_album'];
            $model = new SubirimagenForm();
            $msg = '';

            # Parametros recibidos por POST mediante el formulario
            if ($model->load(Yii::$app->request->post())) {

                if ($model->validate()) {
                    $imagen = new Imagenes();

                    if ($model->imagen = UploadedFile::getInstance($model, 'imagen')) {
                        $imagen->id_mascota = $model->id_mascota;
                        $imagen->id_album = $model->id_album;

                        $imagen->save();

                        $model->upload_imagen($imagen->id);
                        $imagen->nombre = ''.$imagen->id.'-'.$model->imagen->name;

                        $imagen->save();

                        $msg = 'Su imágen se ha subido con exito';
                    }else{
                        $msg = 'Seleccione una imagen para subir';
                    }

                    
                }          

            }

            $query = Imagenes::find()->where(['id_album' => $id_album]);
            $countQuery = clone $query;
            $pages = new Pagination([
                'pageSize' => 9,
                'totalCount' => $countQuery->count(),            
            ]);
            $imagenes = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            # Al acceder por GET inicializaremos las variables id_mascota e id_album
            $model->id_mascota = $this->getId();
            $model->id_album = $id_album;

            return $this->render('accederalbum',['model' => $model,'msg' => $msg, 'imagenes' => $imagenes, 'pages' => $pages, 'id_amigo' => $id_amigo]);
    }

    public function actionEliminaralbum(){

        if (Yii::$app->request->post()){
            # Obtenemos el id del álbum enviado por GET
            $id_album = $_POST['id_album'];
            # Obtenemos el id de la mascota
            $mascota_id = $this->getId();
            # Creamos el path donde esta guardado el album de la mascota
            $carpeta = ''.Yii::$app->params['urlBaseImg'].'/mascotas/mascota-'.$mascota_id.'/albumes/album-'.$id_album;
            # Eliminamos la carpeta y todas las imágenes asociadas a este álbum
            $this->eliminarCarpeta($carpeta);
            # Buscamos el álbum en la bd para eliminarlo de ella
            $album = Albumes::findOne($id_album);
            $album->delete();
            # Eliminamos todas las imagenes asociadas al album de en la bd
            $imagenes = Imagenes::find()->where(['id_album' => $id_album])->all();
            foreach ($imagenes as $row) {
                $row->delete();
            }
            $this->redirect(["mascotas/albumes"]);
        }
    }

    public function eliminarCarpeta($carpeta){

        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
            //echo $archivos_carpeta;
     
            if (is_dir($archivos_carpeta))
            {
                $this->eliminarCarpeta($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }
     
        rmdir($carpeta);
    }

    public function actionBuscarmascotas(){

        $model = new BuscarmascotasForm();

        # Parametros recibidos por POST mediante el formulario
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $mascotas = new Mascotas();
                $query = "SELECT * FROM mascotas WHERE id NOT LIKE '".$this->getId()."'";

                if (!empty($model->nombre)) {
                    $query .= " AND nombre LIKE '".$model->nombre."'";
                }

                if (!empty($model->animal)) {
                    $query .= " AND animal LIKE '".$model->animal."'";
                }
                
                if (!empty($model->raza)) {
                    $query .= " AND raza LIKE '".$model->raza."'";
                }
                if (!empty($model->sexo)) {
                    $query .= " AND sexo LIKE '".$model->sexo."'";
                }
                if (!empty($model->hogar)) {
                    $query .= " AND hogar LIKE '".$model->hogar."'";
                }

                $mascotas = $mascotas->findBySql($query);
                
                $countQuery = clone $mascotas;
                $pages = new Pagination([
                    'pageSize' => 9,
                    'totalCount' => $countQuery->count(),            
                ]);
                $mascotas = $mascotas->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

                # Preparamos la lista de amigos para no mostrarlos en la vista
                $amigos = new Amigos();
                $query = "SELECT id_amigo FROM amigos WHERE id_mascota LIKE '".$this->getId()."'";
                $amigos = $amigos->findBySql($query)->all();

                $arrayAmigos = array();
                foreach ($amigos as $amigo) {
                    array_push($arrayAmigos, $amigo->id_amigo);
                }

                return $this->render('resultadobusqueda',['mascotas' => $mascotas, 'pages' => $pages, 'arrayAmigos' => $arrayAmigos]);

            }
        }

        return $this->render('buscarmascotas',['model' => $model]);
    }

    public function actionVeramigos(){

        $id = $this->getId();

        $amigos = new Mascotas();
        $query = "SELECT * FROM mascotas M, amigos A WHERE A.id_mascota = '". $id."' AND M.id = A.id_amigo";
        $amigos = $amigos->findBySql($query);

        $countQuery = clone $amigos;
        $pages = new Pagination([
            'pageSize' => 9,
            'totalCount' => $countQuery->count(),            
        ]);
        $amigos = $amigos->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('veramigos',['amigos' => $amigos, 'pages' => $pages]);
    }

    public function actionVerpeticiones(){
        $id = $this->getId();

        $mascotas = new Mascotas();
        $query = "SELECT * FROM mascotas M, peticiones P WHERE P.id_solicitado = '". $id."' AND M.id = P.id_solicitante";
        $mascotas = $mascotas->findBySql($query);

        $countQuery = clone $mascotas;
        $pages = new Pagination([
            'pageSize' => 9,
            'totalCount' => $countQuery->count(),            
        ]);
        $mascotas = $mascotas->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('verpeticiones',['mascotas' => $mascotas, 'pages' => $pages]);
    }

    public function actionEliminaramigo(){

        $id = $this->getId();
        $id_amigo = $_POST['id_mascota'];

        # Obtenemos el id de la amistad
        $amigo = Amigos::find()->where(['id_mascota' => $id, 'id_amigo' => $id_amigo])->all();
        # Con ese id borramos la amistad en un sentido
        $amistad = Amigos::findOne($amigo[0]->id_amistad);
        $amistad->delete();

        # Obtenemos el id de la amistad
        $amigo = Amigos::find()->where(['id_mascota' => $id_amigo, 'id_amigo' => $id])->all();
        # Con ese id borramos la amistad en el otro sentido
        $amistad = Amigos::findOne($amigo[0]->id_amistad);
        $amistad->delete();

        $this->redirect(['mascotas/veramigos']);

    }

    public function actionEnviarsolicitud(){

        $id_solicitante = $this->getId();
        $id_solicitado = $_GET['id_mascota'];

        $peticion = new Peticiones();
        $peticion->id_solicitante = $id_solicitante;
        $peticion->id_solicitado = $id_solicitado;
        $peticion->save();

        return $this->render('solicitudenviada');

    }

    public function actionAceptarpeticion(){

        $id_solicitante = $_GET['id_mascota'];
        $id_solicitado = $this->getId();

        # Obtenemos el id de la peticion
        $peticion = Peticiones::find()->where(['id_solicitante' => $id_solicitante, 'id_solicitado' => $id_solicitado])->all();

        # Con ese id borramos la peticion
        $peticion = Peticiones::findOne($peticion[0]->id_peticion);
        $peticion->delete();

        # Ahora creamos las relaciones de amistad
        $amigos = new Amigos();
        $amigos->id_mascota = $id_solicitado;
        $amigos->id_amigo = $id_solicitante;
        $amigos->save();

        $amigos = new Amigos();
        $amigos->id_mascota = $id_solicitante;
        $amigos->id_amigo = $id_solicitado;
        $amigos->save();

        $this->redirect(['mascotas/veramigos']);

    }   

    public function actionRechazarpeticion(){

        $id_solicitante = $_GET['id_mascota'];
        $id_solicitado = $this->getId();

        # Obtenemos el id de la peticion
        $peticion = Peticiones::find()->where(['id_solicitante' => $id_solicitante, 'id_solicitado' => $id_solicitado])->all();

        # Con ese id borramos la peticion
        $peticion = Peticiones::findOne($peticion[0]->id_peticion);
        $peticion->delete();

        $this->redirect(['mascotas/verpeticiones']);
    } 

    public function actionVermsjentrada(){

        $id = $this->getId();

        # Obtenemos todos los mensajes recibidos de la mascota
        $mensajes = Mensajes::find()->where(['id_receptor' => $id]);

        $countQuery = clone $mensajes;
        $pages = new Pagination([
            'pageSize' => 10,
            'totalCount' => $countQuery->count(),            
        ]);
        $mensajes = $mensajes->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('vermsjentrada',['mensajes' => $mensajes,'pages' => $pages]);
    }

    public function actionVermsjenviados(){

        $id = $this->getId();

        # Obtenemos todos los mensajes enviados por la mascota
        $mensajes = Mensajes::find()->where(['id_emisor' => $id]);

        $countQuery = clone $mensajes;
        $pages = new Pagination([
            'pageSize' => 10,
            'totalCount' => $countQuery->count(),            
        ]);
        $mensajes = $mensajes->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('vermsjenviados',['mensajes' => $mensajes, 'pages' => $pages]);
    }

    public function actionEnviarmensaje(){

        $model = new EnviarmsjForm();
        $amigos = new Mascotas();
        $msg = '';
        $id = $this->getId();
        $arrayAmigos = array();

        # Al acceder por GET
        if (Yii::$app->request->get())
        {         
            # Buscamos en la BD todos los amigos de la mascota para poder enviarles mensajes
            $query = "SELECT * FROM mascotas M, amigos A WHERE A.id_mascota = '". $id."' AND M.id = A.id_amigo";
            $amigos = $amigos->findBySql($query)->all();

            foreach ($amigos as $row) {
                $arrayAmigos[$row->id] = $row->nombre;
            }

            # Pasamos los datos al formulario
            $model->amigos = $arrayAmigos;
            $model->id_mascota = $id;

        }

        # Parametros recibidos por POST al actualizar el formulario
        if($model->load(Yii::$app->request->post()))
        {

            # Obtenemos la fecha actual para insertarla en la BD
            $fecha = getdate();
            $fecha = $fecha['mday'].'-'.$fecha['mon'].'-'.$fecha['year'];

            # Obtenemos los datos de la mascota actual para escribir su nombre en la BD
            $mascota = Mascotas::findOne($id);

            # Guardamos el mensaje en la BD
            $mensaje = new Mensajes();
            $mensaje->id_emisor = $model->id_mascota;
            $mensaje->nombre_emisor = $mascota->nombre;
            $mensaje->id_receptor = $model->amigos;
            $mensaje->nombre_receptor = $arrayAmigos[$model->amigos];
            $mensaje->asunto = $model->asunto;
            $mensaje->estado = "no leido";
            $mensaje->contenido = $model->mensaje;
            $mensaje->fecha_envio = $fecha;
            $mensaje->save();

            # Reiniciamos el modelo
            $model->amigos = $arrayAmigos;
            $model->asunto = "";
            $model->mensaje = "";

            $msg = "El mensaje se ha enviado correctamente";

        }

        return $this->render('enviarmensaje',['model' => $model, 'msg' => $msg]);

    }

    public function actionEliminarmsj(){

        # Obtenemos el id enviado por el modal
        $id_mensaje = $_POST['id_mensaje'];

        # Buscamos el mensaje y lo eliminamos
        $mensaje = Mensajes::findOne($id_mensaje);
        $mensaje->delete();

        # Redirigimos a la vista de mensajes de entrada sin el mensaje
        $this->redirect(['mascotas/vermsjentrada']);
    }

    public function actionVermsjunico(){

        # Obtenemos el id enviado por el enlace
        $id_mensaje = $_GET['id_mensaje'];

        # Buscamos el mensaje y actualizamos el estado a 'leido'
        $mensaje = Mensajes::findOne($id_mensaje);
        $mensaje->estado = 'leido';
        $mensaje->update();

        # Renderizamos la vista del mensaje
        return $this->render('vermsjunico',['mensaje' => $mensaje]);
    }

    public function actionVermuro(){

        $id_amigo = '';

        # Obtenemos el id actual de la mascota y lo pasamos al ActiveForm
        $id = $this->getId();
        $model = new CrearpostForm();
        $model->id_mascota = $id;

        # Comprobamos si se esta accediendo para ver el perfil del amigo a nuestras imágenes
        if (Yii::$app->request->get('id_amigo'))
        {
            $id_amigo = $_GET['id_amigo'];
            $posts = Posts::find()->where(['id_mascota' => $id_amigo])->orderBy('id DESC');
        }else
        {
            $posts = Posts::find()->where(['id_mascota' => $id])->orderBy('id DESC');
        }        

        # Si enviamos el formulario
        if($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()){
                $post = new Posts();
                $post->id_mascota = $model->id_mascota;
                $post->contenido = $model->contenido;

                # Comprobamos si se ha subido una imagen y la guardamos tanto en la carpeta adecuada como en la BD
                if ($model->imagen = UploadedFile::getInstance($model, 'imagen')) {

                    $model->upload_imagen();
                    $post->imagen = ''.$model->imagen->name;    
                }

                $post->save();
                $model->contenido = '';

            }
        }

        $countQuery = clone $posts;
        $pages = new Pagination([
            'pageSize' => 5,
            'totalCount' => $countQuery->count(),            
        ]);
        $posts = $posts->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('vermuro',['model' => $model, 'pages' => $pages, 'posts' => $posts,'id_amigo' => $id_amigo]);
    }


    public function actionEliminarpost(){

        # Obtenemos el id enviado por el modal
        $id_post = $_POST['id_post'];

        # Obtenemos los datos del post para eliminar la imagen si existe
        $post = Posts::findOne($id_post);
        if($post->imagen != '')
        {
            # Eliminamos la imagen
            unlink(Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$post->id_mascota.'/posts/'.$post->imagen);

        }        

        # Eliminamos el post de la BD
        $post->delete();

        # Redirigimos a la vista del muro
        $this->redirect(['mascotas/vermuro']);

    }

    # Ver algunos datos del perfil de la mascota amiga
    public function actionVerperfil(){

        $id_amigo = $_GET['id_amigo'];

        $amigo = Mascotas::findOne($id_amigo);
        $edad = $this->edad($amigo->fecha_nacimiento);

        return $this->render('verperfil',['id_amigo' => $id_amigo, 'amigo' => $amigo,'edad' => $edad]);
    }

    # Ver algunos datos del perfil de dueño de una mascota amiga
    public function actionVerdueno(){
        $id_amigo = $_GET['id_amigo'];

        $amigo = Mascotas::findOne($id_amigo);
        $dueno = Usuarios::findOne($amigo->id_usuario);
        $edad = $this->edad($dueno->fecha_nacimiento);

        return $this->render('verdueno',['id_amigo' => $id_amigo, 'dueno' => $dueno,'edad' => $edad]);
    }

    # Calclamos la edad a partir de una fecha en formato dd-mm-yyy
    public function edad($fecha){
        
        # Fecha actual
        $dia = date(j);
        $mes = date(n);
        $ano = date(Y);

        # fecha de nacimiento
        $fecha = explode('-', $fecha);
        $dianacimiento = $fecha[0];
        $mesnacimiento = $fecha[1];
        $anonacimiento = $fecha[2];

        # Si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
        if (($mesnacimiento == $mes) && ($dianacimiento > $dia)) 
        {
            $ano = ($ano-1); 
        }

        # Si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
        if ($mesnacimiento > $mes) 
        {
            $ano = ($ano-1);
        }

        # Ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
        $edad = ($ano-$anonacimiento);

        return $edad;
    }

}
