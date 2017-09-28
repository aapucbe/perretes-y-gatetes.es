<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Ver perfil';
?>

<div class="div-center">	
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Dueño', ['mascotas/verdueno', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li class="active"><?= Html::a('Enviar mensaje', ['mascotas/enviarmsjcruce', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	</ul>
</div>
<div class="border-box div-center" style="padding: 15px">

	<h3><?= $msg ?></h3>
	<?php $form = ActiveForm::begin([
            'id' => 'enviar-msj-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

	<?= $form->field($model, "id_mascota")->hiddenInput()->label(false) ?>

    <?= $form->field($model, "amigos")->hiddenInput()->label(false) ?>    

    <?= $form->field($model, "mensaje")->textarea() ?>

    <?= $form->field($model, "asunto")->hiddenInput()->label(false) ?>    

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 div-center">
            <?= Html::submitButton('Enviar mensaje', ['class' => 'btn btn-primary', 'name' => 'enviarmsj-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>