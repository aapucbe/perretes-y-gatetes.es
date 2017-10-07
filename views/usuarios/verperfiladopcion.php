<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Mis imagenes';

?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Buscar en adopción', ['usuarios/buscaradopcion', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	</ul>
</div>

<div class="row" style="margin-top:1.7em; margin-left: 1em">
		<div class="col-lg-4 col-md-4 col-sm-12">
			<p><strong>Nombre: </strong><?= $adopcion->nombre ?></p>
			<p><strong>Raza: </strong><?= $adopcion->raza ?></p>	
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12">
			<p><strong>Edad: </strong><?= $adopcion->edad ?></p>
			<p><strong>Sexo: </strong><?= $adopcion->sexo ?></p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12">
			<p><strong>Población: </strong><?= $adopcion->poblacion ?></p>
			<p><strong>Correo de contacto: </strong><?= $correo ?></p>
		</div>
	<hr>
	<div class="row" style="margin-top:5em">
		<?php
		foreach ($imagenes as $row) {	
		?>

		<div class="col-lg-4 col-md-4 col-sm-12">
			<a href=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$adopcion->id_mascota.'/adopciones/adopcion-'.$adopcion->id.'/'.$row->nombre.'"' ?> data-lightbox="galeria"><img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$adopcion->id_mascota.'/adopciones/adopcion-'.$adopcion->id.'/'.$row->nombre.'"' ?>></a>
		</div>
		<?php
		}
		?>
	</div>
</div>