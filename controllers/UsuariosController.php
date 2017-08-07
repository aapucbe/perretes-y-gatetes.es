<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PerfilForm;
use app\models\Usuarios;
use app\models\Mascotas;
use app\models\CrearmascotaForm;
use yii\web\UploadedFile;

class UsuariosController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'layout_usuarios';

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
        $this->redirect(['usuarios/vermascotas']);
    }

    public function actionPerfil(){

        $model = new PerfilForm;
        $msg = null;

        # Parametros recibidos por POST al actualizar el formulario
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate()){
                
                $usuario = Usuarios::findOne($model->id);
                # Comprobamos que exista ese usuario
                if($usuario){

                    $model->foto_perfil = UploadedFile::getInstance($model, 'foto_perfil');
                    if($model->foto_perfil){
                        $model->upload_perfil();
                        $usuario->foto_perfil = 'foto_perfil.'.$model->foto_perfil->extension;
                        $usuario->foto_perfil_mod = 1;                       
                    }

                    $model->foto_cabecera = UploadedFile::getInstance($model, 'foto_cabecera');
                    if($model->foto_cabecera){
                        $model->upload_cabecera();
                        $usuario->foto_cabecera = 'foto_cabecera.'.$model->foto_cabecera->extension;
                        $usuario->foto_cabecera_mod = 1;                        
                    }

                    $usuario->nombre = $model->nombre;
                    $usuario->apellidos = $model->apellidos;
                    $usuario->email = $model->email;
                    $usuario->fecha_nacimiento = $model->fecha_nacimiento;
                    $usuario->descripcion = $model->descripcion;                    
                    if ($model->password_nueva) {
                        $usuario->password = crypt($model->password_nueva, Yii::$app->params['salt']);
                    }

                    if ($usuario->update())
                    {
                        $msg = "Sus datos han sido actualizados correctamente";
                    }else
                    {
                        $msg = "Sus datos han sido actualizados correctamente";
                    }
                }
            }
        }

        # Parametro recibido por GET al pulsar sobre Perfil del menu sidebar
        if (Yii::$app->request->get("id")){
            # Desciframos el id
            $id = base64_decode($_GET["id"]);

            # Guardamos los datos para insertarlos en el formulario al modo de placeholders
            $usuario = Usuarios::findOne($id);
            # Comprobamos que exista ese id
            if($usuario)
            {
                $model->id = $usuario->id;
                $model->nombre = $usuario->nombre;
                $model->apellidos = $usuario->apellidos;
                $model->email = $usuario->email;
                $model->fecha_nacimiento = $usuario->fecha_nacimiento;
                $model->descripcion = $usuario->descripcion;                
            }

        }        

        return $this->render('perfil',['model' => $model, 'msg' => $msg]);
    }

    public function actionCrearmascota(){

        # Antes de pasar a crear la nueva mascota comprobamos que tiene menos de 6 mascotas
        $model = Mascotas::find()
                ->where(["like", "id_usuario", Yii::$app->user->identity->id])
                ->all();

        $count = count($model);

        if ($count<6) {
            $model = new CrearmascotaForm();
            $msg = '';

            # Parametro recibido por GET al pulsar sobre Perfil del menu sidebar
            if (Yii::$app->request->get("id")){
                # Desciframos el id
                $id = base64_decode($_GET["id"]);
                $usuario = Usuarios::findOne($id);

                # Comprobamos que exista ese id
                if($usuario){
                    $model->id_usuario = $usuario->id;
                    $model->email_usuario = $usuario->email;
                }
            }

            # Parametros recibidos por POST al actualizar el formulario
            if($model->load(Yii::$app->request->post())){
                $mascota = new Mascotas();

                if($model->validate()){

                    $mascota->nombre = $model->nombre;
                    $mascota->animal = $model->animal;
                    $mascota->raza = $model->raza;
                    $mascota->fecha_nacimiento = $model->fecha_nacimiento;
                    $mascota->hogar = $model->hogar;
                    $mascota->foto_perfil = "perfil-default.png";
                    $mascota->foto_cabecera = "jumbotron-default.png";
                    $mascota->id_usuario = $model->id_usuario;
                    $mascota->email_usuario = $model->email_usuario;
                    $mascota->save();

                    $msg = "La mascota ha sido insertada con exito";

                }

            }

            return $this->render('crearmascota',['model' => $model, 'msg' => $msg]);
        }else{
            return $this->render('muchasmascotas');
        }

            
    }

    public function actionVermascotas(){

        $model = Mascotas::find()
                ->where(["like", "id_usuario", Yii::$app->user->identity->id])
                ->all();

        $count = count($model);

    return $this->render("vermascotas", ["model" => $model, "count" => $count]);
        
    }

    public function actionEliminarmascota(){
        if (Yii::$app->request->post()) {

            $id = $_POST['id_mascota'];
            $mascota = Mascotas::findOne($id);
            $msg = "Mascota ".$mascota->nombre." eliminada correctamente, redireccionando...";
            $mascota->delete();            
            $this->redirect(["usuarios/vermascotas"]);
        }
    }
}
