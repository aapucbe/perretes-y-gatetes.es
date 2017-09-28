<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Mis álbumes';
if ($id_amigo != '') {

?>

<div class="div-center">
	<?php
		if ($cruce == 'Si') {	
	?>
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li class="active"><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Dueño', ['mascotas/verdueno', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Enviar mensaje', ['mascotas/enviarmsjcruce', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	</ul>
	<?php
		}else{
	?>

	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo]) ?></li>
	  <li class="active"><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Dueño', ['mascotas/verdueno', 'id_amigo' => $id_amigo]) ?></li>
	</ul>

	<?php
		}
	?>
</div>

<?php
}else{
?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Imágenes', ['mascotas/imagenes']) ?></li>
	  <li class="active"><?= Html::a('Álbumes', ['mascotas/albumes']) ?></li>
	</ul>
</div>

<?php
}
?>

<div class="border-box div-center" style="padding: 15px">

	<?php
	if ($id_amigo == '') {
	?>
	<div class="row">
		<?= Html::a('Crear álbum', ['mascotas/crearalbum'],['class' => 'btn btn-primary']) ?>
	</div>
	<hr>
	<?php
		}
		$i=1;
		foreach($albumes as $row):
			if($i%3 == 1){
	?>
		<div class="row">
			<div class="col-lg-4">
			<div class="row">
				<p><strong><em><?= $row->nombre ?></em></strong></p>
			</div>
				<div class="row">
					<img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->imagen_destacada.'"' ?>>
				</div>			
				<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
					<?php
					if ($id_amigo == '') {
					?>
		            <div class="col-lg-12">		            
		            	<div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id],['class' => 'btn btn-default']) ?></div>
		            	<div class="col-lg-6 col-md-6 div-eliminar">
		                	<!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
		                	<a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_album<?= $row->id ?>">Eliminar</a>
			                <div class="modal fade" role="dialog" aria-hidden="true" id="id_album<?= $row->id ?>">
			                          <div class="modal-dialog">
			                                <div class="modal-content">
			                                  <div class="modal-header">
			                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			                                        <h4 class="modal-title">Eliminar album</h4>
			                                  </div>
			                                  <div class="modal-body">
			                                        <p>¿Realmente deseas eliminar el álbum?</p>
			                                  </div>
			                                  <div class="modal-footer">
			                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminaralbum"), "POST") ?>
			                                        <input type="hidden" name="id_album" value="<?= $row->id ?>">
			                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			                                        <button type="submit" class="btn btn-primary">Eliminar</button>
			                                  <?= Html::endForm() ?>
			                                  </div>
			                                </div><!-- /.modal-content -->
			                          </div><!-- /.modal-dialog -->
			                </div><!-- /.modal -->
			            </div>              
		            </div> 
					<?php
					}else{
					?>
					<div class="col-lg-12">
						<div class="col-lg-12 col-md-12"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id,'id_amigo' => $id_amigo, 'cruce' => $cruce],['class' => 'btn btn-default']) ?></div>
					</div>
					<?php
					}
					?>
		        </div>
		    </div>

		<?php
			$i++;
			}else if($i%3 == 2) {
		?>
			<div class="col-lg-4">
			<div class="row">
				<p><strong><em><?= $row->nombre ?></em></strong></p>
			</div>
				<div class="row">
					<img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->imagen_destacada.'"' ?>>
				</div>			
				<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
		            <?php
					if ($id_amigo == '') {
					?>
		            <div class="col-lg-12">
		            	<div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id],['class' => 'btn btn-default']) ?></div>
		            	<div class="col-lg-6 col-md-6 div-eliminar">
			                <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
			                <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_album<?= $row->id ?>">Eliminar</a>
			                <div class="modal fade" role="dialog" aria-hidden="true" id="id_album<?= $row->id ?>">
			                          <div class="modal-dialog">
			                                <div class="modal-content">
			                                  <div class="modal-header">
			                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			                                        <h4 class="modal-title">Eliminar album</h4>
			                                  </div>
			                                  <div class="modal-body">
			                                        <p>¿Realmente deseas eliminar el álbum?</p>
			                                  </div>
			                                  <div class="modal-footer">
			                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminaralbum"), "POST") ?>
			                                        <input type="hidden" name="id_album" value="<?= $row->id ?>">
			                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			                                        <button type="submit" class="btn btn-primary">Eliminar</button>
			                                  <?= Html::endForm() ?>
			                                  </div>
			                                </div><!-- /.modal-content -->
			                          </div><!-- /.modal-dialog -->
			                </div><!-- /.modal -->
			            </div>              
		            </div> 
					<?php
					}else{
					?>
					<div class="col-lg-12">
						<div class="col-lg-12 col-md-12"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id,'id_amigo' => $id_amigo, 'cruce' => $cruce],['class' => 'btn btn-default']) ?></div>
					</div>
					<?php
					}
					?>
		        </div>
		    </div>
		<?php
			$i++;
			}else if($i%3 == 0){
		?>
			<div class="col-lg-4">
			<div class="row">
				<p><strong><em><?= $row->nombre ?></em></strong></p>
			</div>
				<div class="row">
					<img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->imagen_destacada.'"' ?>>
				</div>			
				<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
					<?php
					if ($id_amigo == '') {
					?>
		            <div class="col-lg-12">
		            	<div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id],['class' => 'btn btn-default']) ?></div>
		            	<div class="col-lg-6 col-md-6 div-eliminar">
		                	<!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
		                	<a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_album<?= $row->id ?>">Eliminar</a>
			                <div class="modal fade" role="dialog" aria-hidden="true" id="id_album<?= $row->id ?>">
			                          <div class="modal-dialog">
			                                <div class="modal-content">
			                                  <div class="modal-header">
			                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			                                        <h4 class="modal-title">Eliminar album</h4>
			                                  </div>
			                                  <div class="modal-body">
			                                        <p>¿Realmente deseas eliminar el álbum?</p>
			                                  </div>
			                                  <div class="modal-footer">
			                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminaralbum"), "POST") ?>
			                                        <input type="hidden" name="id_album" value="<?= $row->id ?>">
			                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			                                        <button type="submit" class="btn btn-primary">Eliminar</button>
			                                  <?= Html::endForm() ?>
			                                  </div>
			                                </div><!-- /.modal-content -->
			                          </div><!-- /.modal-dialog -->
			                </div><!-- /.modal -->
			            </div>              
		            </div>
					<?php
					}else{
					?>
					<div class="col-lg-12">
						<div class="col-lg-12 col-md-12"><?= Html::a('Acceder', ['mascotas/accederalbum','id_album' => $row->id,'id_amigo' => $id_amigo, 'cruce' => $cruce],['class' => 'btn btn-default']) ?></div>
					</div>
					<?php
					}
					?>
		        </div>
		    </div>
		</div>
			<br>

		<?php
			$i++;
			}
			endforeach
		?>
		<div class="row">
			<div class="col-lg-12">
				<?= LinkPager::widget([
			    "pagination" => $pages,
				]); ?>
			</div>
		</div>
	</div>
</div>