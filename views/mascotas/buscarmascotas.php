<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Buscar Mascota';
?>
<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'buscar-mascota-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'nombre')->textInput() ?>    

    <?= $form->field($model, 'animal')->radioList(['perro' => 'perro','gato' => 'gato']) ?>

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'sexo')->radioList(['macho' => 'macho','hembra' => 'hembra']) ?>

    <?= $form->field($model, 'hogar')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 div-center">
            <?= Html::submitButton('Buscar mascotas', ['class' => 'btn btn-primary', 'name' => 'crearmascota-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>