<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Ver en adopción';

?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('En adopción', ['mascotas/verlistaadopciones']) ?></li>
	  <li class="active"><?= Html::a('Poner en adopción', ['mascotas/ponerenadopcion']) ?></li>
	</ul>
</div>

<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'form-poner-en-adopcion',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, "id_mascota")->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput() ?>

    <?= $form->field($model, 'animal')->radioList(['perro' => 'perro','gato' => 'gato']) ?>

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'sexo')->radioList(['macho' => 'macho','hembra' => 'hembra']) ?>

    <?= $form->field($model, 'edad')->textInput() ?>   

    <?= $form->field($model, 'provincia')->textInput() ?>

    <?= $form->field($model, 'poblacion')->textInput() ?>

    <?= $form->field($model, 'imagenes[]')->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Añadir en adopción', ['class' => 'btn btn-primary', 'name' => 'adopcion-button']) ?>
        </div>
    </div>	    
	    
	<?php ActiveForm::end(); ?>

</div>