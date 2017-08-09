<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Crear Mascota';
?>
<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'miperfil-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, "email_usuario")->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput() ?>    

    <?= $form->field($model, 'animal')->radioList(['perro' => 'perro','gato' => 'gato']) ?>

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'hogar')->textInput() ?>

    <?= $form->field($model, "id_usuario")->hiddenInput()->label(false) ?> 

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Añadir mascota', ['class' => 'btn btn-primary', 'name' => 'crearmascota-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>