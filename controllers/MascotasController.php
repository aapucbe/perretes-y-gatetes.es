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
use app\models\PerfilmascotaForm;
use yii\web\UploadedFile;
use yii\web\Session;

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

    public function getId(){
        $session = Yii::$app->session;
        $session->open();
        $id_mascota = $session['id_mascota'];
        $session->close();
        return $id_mascota;
    }
}
