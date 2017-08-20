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
        return $this->render('index',['session' => $session]);
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

        $query = Imagenes::find()->where(['id_mascota' => $this->getId(), 'id_album' => 0]);
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

        return $this->render('imagenes',['model' => $model,'msg' => $msg, 'imagenes' => $imagenes, 'pages' => $pages]);
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

        $query = Albumes::find()->where(['id_mascota' => $this->getId()]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'pageSize' => 9,
            'totalCount' => $countQuery->count(),            
        ]);
        $albumes = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('albumes',['pages' => $pages, 'albumes' => $albumes]);
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

        if (Yii::$app->request->get()){
            # Obtenemos el id del álbum enviado por GET
            $id_album = $_GET['id_album'];
            $model = new SubirimagenForm();
            $msg = '';

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

            return $this->render('accederalbum',['model' => $model,'msg' => $msg, 'imagenes' => $imagenes, 'pages' => $pages]);
        }    
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

}
