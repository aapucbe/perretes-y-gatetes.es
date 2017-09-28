<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Mi perfil';
?>
<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'miperfil-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, "id")->hiddenInput()->label(false) ?>

    <?= $form->field($model, "email_usuario")->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput() ?>

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'hogar')->textInput() ?>

    <?php
        if ($cruce == 'Si') {
    ?>
    <p><strong>¡Actualmentes estás buscando mascotas con quien cruzarte!</strong></p>
    <?php
        }else{
    ?>
    <p><strong>¡Actualmentes no estás buscando mascotas con quien cruzarte!</strong></p>
    <?php
        }
    ?>

    <?= $form->field($model, 'cruce')->dropDownList(['' => '---', 'Si' => 'Si', 'No' => 'No']) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>   

    <?= $form->field($model, 'descripcion')->textarea() ?>

    <?= $form->field($model, 'foto_perfil')->fileInput() ?>

    <?= $form->field($model, 'foto_cabecera')->fileInput() ?>

    <?= $form->field($model, "id_usuario")->hiddenInput()->label(false) ?>
    
    <br>
    <p><strong>Introduce tu contraseña actual para guardar los cambios</strong></p>
    <?= $form->field($model, 'password_actual')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'miperfil-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>