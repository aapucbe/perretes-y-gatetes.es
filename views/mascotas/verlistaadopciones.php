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
	  <li class="active"><?= Html::a('En adopción', ['mascotas/verlistaadopciones']) ?></li>
	  <li><?= Html::a('Poner en adopción', ['mascotas/ponerenadopcion']) ?></li>
	</ul>
</div>
<div class="site-perfil border-box" style="text-align: left">

	<?php
		foreach ($adopciones as $row) {
	?>

	<div class="row" style="margin-top:1.7em; margin-left: 1em">
		<div class="col-lg-4 col-md-4 col-sm-12" >
			<img src="../../web/images/mascotas/mascota-<?= $row->id_mascota ?>/adopciones/adopcion-<?= $row->id ?>/<?= $row->imagen_portada ?>"  width="70%" height="120px">
		</div>
		<div class="col-lg-6 col-md-8 col-sm-12">
			<p><strong>Nombre: </strong><?= $row->nombre ?></p>
			<p><strong>Raza: </strong><?= $row->raza ?></p>
			<p><strong>Edad: </strong><?= $row->edad ?></p>
			<p><strong>Sexo: </strong><?= $row->sexo ?></p>
			<p><strong>Población: </strong><?= $row->poblacion ?></p>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-12">
			<div class="col-lg-12">
	                <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
	                <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_adopcion<?= $row->id ?>">Eliminar</a>
	                <div class="modal fade" role="dialog" aria-hidden="true" id="id_adopcion<?= $row->id ?>">
	                          <div class="modal-dialog">
	                                <div class="modal-content">
	                                  <div class="modal-header">
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                        <h4 class="modal-title">Eliminar adopción</h4>
	                                  </div>
	                                  <div class="modal-body">
	                                        <p>¿Realmente deseas eliminar esta adopción?</p>
	                                  </div>
	                                  <div class="modal-footer">
	                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminaradopcion"), "POST") ?>
	                                        <input type="hidden" name="id_adopcion" value="<?= $row->id ?>">
	                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                                        <button type="submit" class="btn btn-primary">Eliminar</button>
	                                  <?= Html::endForm() ?>
	                                  </div>
	                                </div><!-- /.modal-content -->
	                          </div><!-- /.modal-dialog -->
	                </div><!-- /.modal -->              
	            </div> 
		</div>
	</div>
	
	<hr>

	<?php
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