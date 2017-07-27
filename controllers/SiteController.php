<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\Usuarios;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    //public $layout = 'layout_usuarios';

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
        # Si es un usuario registrado, redirigimos a su home personal
        if (!Yii::$app->user->isGuest) {
            $this->redirect(["usuarios/index"]);
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->registrar();
            $this->redirect(["site/login"]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Register action
     *
     * @return string
     */
    public function actionRegister()
    {

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->registrar();
            $this->redirect(["site/login"]);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
