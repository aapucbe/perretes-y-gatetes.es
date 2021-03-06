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

if ($id_amigo != '') {

?>

<div class="div-center">
	<?php
		if ($cruce == 'Si') {	
	?>
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li class="active"><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Dueño', ['mascotas/verdueno', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	  <li><?= Html::a('Enviar mensaje', ['mascotas/enviarmsjcruce', 'id_amigo' => $id_amigo, 'cruce' => $cruce]) ?></li>
	</ul>
	<?php
		}else{
	?>

	<ul class="nav nav-tabs">
	  <li><?= Html::a('Perfil', ['mascotas/verperfil', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Muro', ['mascotas/vermuro', 'id_amigo' => $id_amigo]) ?></li>
	  <li class="active"><?= Html::a('Imágenes', ['mascotas/imagenes', 'id_amigo' => $id_amigo]) ?></li>
	  <li><?= Html::a('Álbumes', ['mascotas/albumes', 'id_amigo' => $id_amigo]) ?></li>
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
	  <li class="active"><?= Html::a('Imágenes', ['mascotas/imagenes']) ?></li>
	  <li><?= Html::a('Álbumes', ['mascotas/albumes']) ?></li>
	</ul>
</div>

<?php
}
?>

<div class="border-box div-center" style="padding: 15px">

<?php
if ($id_amigo == ''){
?>
	<div class="row fila-amigos">
		<?php $form = ActiveForm::begin([
            'id' => 'miperfil-form',
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
	    ]); ?>

		<div class="col-lg-2"><?= $form->field($model, "id_mascota")->hiddenInput()->label(false) ?></div>			    

	    <div class="col-lg-4"><?= $form->field($model, 'imagen')->fileInput()->label(false) ?></div>	

	    <div class="col-lg-2"><?= $form->field($model, "id_album")->hiddenInput()->label(false) ?></div>      

		<div class="col-lg-4"><?= Html::submitButton('Subir imagen', ['class' => 'btn btn-primary', 'name' => 'imagen-button']) ?></div>	    
	    
	    <?php ActiveForm::end(); ?>
		<hr>
	</div>

	<?php
		}
		$i=1;
		foreach($imagenes as $row):
			if($i%3 == 1){
	?>

	<div class="row">
		<div class="col-lg-4">
			<div class="row">
				<a href=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?> data-lightbox="galeria"><img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?>></a>
			</div>	
			<?php
			if ($id_amigo == ''){
			?>
			<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
	            <div class="col-lg-12">
	                <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
	                <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_imagen<?= $row->id ?>">Eliminar</a>
	                <div class="modal fade" role="dialog" aria-hidden="true" id="id_imagen<?= $row->id ?>">
	                          <div class="modal-dialog">
	                                <div class="modal-content">
	                                  <div class="modal-header">
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                        <h4 class="modal-title">Eliminar imagen</h4>
	                                  </div>
	                                  <div class="modal-body">
	                                        <p>¿Realmente deseas eliminar la imagen?</p>
	                                  </div>
	                                  <div class="modal-footer">
	                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminarimagen"), "POST") ?>
	                                        <input type="hidden" name="id_imagen" value="<?= $row->id ?>">
	                                        <input type="hidden" name="id_album" value="<?= $row->id_album ?>">
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
			}
			?>
	    </div>

	<?php
		$i++;
		}else if($i%3 == 2) {
	?>
		<div class="col-lg-4">
			<div class="row">
				<a href=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?> data-lightbox="galeria"><img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?>></a>
			</div>
			<?php
			if ($id_amigo == ''){
			?>			
			<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
	            <div class="col-lg-12">
	                <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
	                <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_imagen<?= $row->id ?>">Eliminar</a>
	                <div class="modal fade" role="dialog" aria-hidden="true" id="id_imagen<?= $row->id ?>">
	                          <div class="modal-dialog">
	                                <div class="modal-content">
	                                  <div class="modal-header">
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                        <h4 class="modal-title">Eliminar imagen</h4>
	                                  </div>
	                                  <div class="modal-body">
	                                        <p>¿Realmente deseas eliminar la imagen?</p>
	                                  </div>
	                                  <div class="modal-footer">
	                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminarimagen"), "POST") ?>
	                                        <input type="hidden" name="id_imagen" value="<?= $row->id ?>">
	                                        <input type="hidden" name="id_album" value="<?= $row->id_album ?>">
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
			}
			?>
	    </div>
	<?php
		$i++;
		}else if($i%3 == 0){
	?>
		<div class="col-lg-4">
			<div class="row">
				<a href=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?> data-lightbox="galeria"><img class="img-thumbnail" src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id_mascota.'/imagenes/'.$row->nombre.'"' ?>></a>
			</div>
			<?php
			if ($id_amigo == ''){
			?>				
			<div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
	            <div class="col-lg-12">
	                <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
	                <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_imagen<?= $row->id ?>">Eliminar</a>
	                <div class="modal fade" role="dialog" aria-hidden="true" id="id_imagen<?= $row->id ?>">
	                          <div class="modal-dialog">
	                                <div class="modal-content">
	                                  <div class="modal-header">
	                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                                        <h4 class="modal-title">Eliminar imagen</h4>
	                                  </div>
	                                  <div class="modal-body">
	                                        <p>¿Realmente deseas eliminar la imagen?</p>
	                                  </div>
	                                  <div class="modal-footer">
	                                  <?= Html::beginForm(Url::toRoute("mascotas/eliminarimagen"), "POST") ?>
	                                        <input type="hidden" name="id_imagen" value="<?= $row->id ?>">
	                                        <input type="hidden" name="id_album" value="<?= $row->id_album ?>">
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
			}
			?>
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