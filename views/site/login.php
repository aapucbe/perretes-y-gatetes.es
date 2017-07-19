<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';
?>
<div class="site-login">

    <div class="col-lg-3"></div>

    <div class="col-lg-6 border-box div-center div-top">
        <h1><?= Html::encode($this->title) ?></h1>
        <h3><?= $_GET['token'] ?></h3>
        <p>Rellena los siguientes campos para iniciar sesión:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
        ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
    
    <div class="col-lg-3"></div>   

</div>
