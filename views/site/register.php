<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrate';
?>
<div class="site-register">

    <div class="col-lg-3"></div>

    <div class="col-lg-6 border-box div-center div-top">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Rellena el siguiente formulario para registrarte en Perretes y Gatetes:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'layout' => 'horizontal',
        ]); ?>

            <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'apellidos')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'repeat_password')->passwordInput() ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-lg-3"></div>
        
</div>
