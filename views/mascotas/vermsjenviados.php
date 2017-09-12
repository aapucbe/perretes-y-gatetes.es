<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Mensajes enviados';
?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Entrada', ['mascotas/vermsjentrada']) ?></li>
	  <li class="active"><?= Html::a('Enviados', ['mascotas/vermsjenviados']) ?></li>
	  <li><?= Html::a('Enviar mensaje', ['mascotas/enviarmensaje']) ?></li>
	</ul>
</div>
<div class="border-box div-center" style="padding: 15px">

	<!-- Vista de los mensajes y botones eliminar -->
	<table class="table">
  		<tbody>
  			<tr class="cabecera-tabla">
  				<th>Para</th>
  				<th>Asunto</th>
  				<th>Fecha</th>
  				<th></th>
  				<th></th>
  			</tr>

		<?php

			foreach ($mensajes as $row) {
				if ($row->estado == "no leido") {
					

		?>

  			<tr class="mensaje-no-leido">

  		<?php

  			}else if($row->estado == "leido"){

  		?>

  			<tr>

  		<?php
  			}
  		?>
  				<th><?= $row->nombre_receptor ?></th>
  				<th><?= $row->asunto ?></th>
  				<th><?= $row->fecha_envio ?></th>
  				<th><?= Html::a('Leer', ['mascotas/vermsjunico', 'id_mensaje' => $row->id],['class' => 'btn btn-default']) ?></th>
  				<th>
  					<!-- Utilizamos un modal para que diga si esta seguro de eliminar el mensaje -->               
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_mensaje_<?= $row->id ?>">Eliminar</a>
                        <div class="modal fade" role="dialog" aria-hidden="true" id="id_mensaje_<?= $row->id ?>">
                                  <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar mensaje</h4>
                                          </div>
                                          <div class="modal-body">
                                                <p>¿Realmente deseas eliminar este mensaje?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <?= Html::beginForm(Url::toRoute("mascotas/eliminarmsj")) ?>
                                                <input type="hidden" name="id_mensaje" value="<?= $row->id ?>">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                          <?= Html::endForm() ?>
                                          </div>
                                        </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->  
  				</th>
  			</tr>

		<?php

			}

		?>

  		</tbody>
	</table>

	<div class="row">
		<div class="col-lg-12">
			<?= LinkPager::widget([
		    "pagination" => $pages,
			]); ?>
		</div>
	</div>

</div>