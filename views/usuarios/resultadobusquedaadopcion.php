<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Ver lista en adopción';

?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li class="active"><?= Html::a('Buscar en adopción', ['usuarios/buscaradopcion']) ?></li>
	</ul>
</div>
<div class="site-perfil border-box" style="text-align: left">

	<?php
		$i = 0;
		foreach ($adopciones as $row) {
	?>

	<div class="row" style="margin-top:1.7em; margin-left: 1em">
		<div class="col-lg-4 col-md-4 col-sm-12" >
			<img src="../../web/images/mascotas/mascota-<?= $row->id_mascota ?>/adopciones/adopcion-<?= $row->id ?>/<?= $row->imagen_portada ?>"  width="70%" height="120px">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<p><strong>Nombre: </strong><?= $row->nombre ?></p>
			<p><strong>Raza: </strong><?= $row->raza ?></p>
			<p><strong>Edad: </strong><?= $row->edad ?></p>
			<p><strong>Sexo: </strong><?= $row->sexo ?></p>
			<p><strong>Población: </strong><?= $row->poblacion ?></p>
			<p><strong>Correo de contacto: </strong><?= $arrayCorreos[$i] ?></p>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-12"><?= Html::a('Acceder', ['usuarios/verperfiladopcion','id_adopcion' => $row->id],['class' => 'btn btn-default']) ?></div>
	</div>
	
	<hr>

	<?php
		$i++;
		}
	?>

	<div class="row">
		<div class="col-lg-12">
			<?= LinkPager::widget([
		    "pagination" => $pages,
			]); ?>
		</div>
	</div>

</div>