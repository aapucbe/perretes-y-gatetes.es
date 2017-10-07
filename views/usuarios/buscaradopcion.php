<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Buscar en adopción';

?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li class="active"><?= Html::a('Buscar en adopción', ['usuarios/buscaradopcion']) ?></li>
	</ul>
</div>

<div class="site-perfil border-box div-center" style="text-align: left">
    <h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'form-poner-en-adopcion',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'animal')->radioList(['perro' => 'perro','gato' => 'gato']) ?>

    <?= $form->field($model, 'raza')->textInput() ?>

    <?= $form->field($model, 'sexo')->radioList(['macho' => 'macho','hembra' => 'hembra']) ?>

    <?= $form->field($model, 'provincia')->textInput() ?>

    <?= Html::submitButton('Buscar adopción', ['class' => 'btn btn-primary', 'name' => 'adopcion-button']) ?>	    
	    
	<?php ActiveForm::end(); ?>

</div>