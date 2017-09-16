<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Ver dueño';
?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo]) ?></li>
	  <li class="active"><?= Html::a('Dueño', ['mascotas/verdueno', 'id_amigo' => $id_amigo]) ?></li>
	</ul>
</div>
<div class="border-box div-center" style="padding: 15px">
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12">
			<!-- Comprobamos si ha modificado la imagen por defecto -->
                <?php
                    if ($dueno->foto_perfil_mod == 1) {
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].'usuarios/usuario-'.$dueno->id.'/'.$dueno->foto_perfil.'"' ?> alt="foto perfil dueño" class="img-responsive" width="90px" height="90px" style="height:90px">
                <?php
                    }else{
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].$dueno->foto_perfil.'"' ?> alt="foto perfil dueño" class="img-responsive" width="90px" height="90px" style="height:90px">
                <?php
                    }
                ?>
		</div>
		<div class="col-lg-8 col-md-6 col-sm-12" style="text-align: left">
			<p><strong>Nombre:</strong> <?= $dueno->nombre ?></p>
			<p><strong>Email:</strong> <?= $dueno->email ?></p>
			<p><strong>Edad:</strong> <?= $edad ?> años</p>
		</div>
	</div>
	<div class="row">
		<p style="text-align: justify; margin-top:1em; margin-left:6em; margin-right:6em;"><strong>Descripción:</strong> <?= $dueno->descripcion ?></p>
	</div>
</div>