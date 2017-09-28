<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Buscar Cruce';
?>
<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'buscar-cruce-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, "animal")->hiddenInput()->label(false) ?>    

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'hogar')->textInput() ?>

    <?= $form->field($model, "sexo")->hiddenInput()->label(false) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 div-center">
            <?= Html::submitButton('Buscar mascotas', ['class' => 'btn btn-primary', 'name' => 'buscarcruce-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>