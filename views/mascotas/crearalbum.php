<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Crear Álbum';
?>
<div class="border-box div-center" style="padding: 15px">
	<div class="row">
		<?php $form = ActiveForm::begin([
            'id' => 'crear-album-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
	    ]); ?>

		<?= $form->field($model, "id_mascota")->hiddenInput()->label(false) ?>			    

		<?= $form->field($model, "nombre")->textInput() ?>

		<?= Html::submitButton('Crear álbum', ['class' => 'btn btn-primary', 'name' => 'album-button']) ?>	    
	    
	    <?php ActiveForm::end(); ?>
		<hr>
	</div>