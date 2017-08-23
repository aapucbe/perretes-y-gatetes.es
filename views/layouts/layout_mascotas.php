<?php $this->beginContent('@app/views/layouts/main.php'); 
	
	use yii\helpers\Html;
	use yii\web\Session;
	use app\models\Mascotas;

	$session = Yii::$app->session;
    $session->open();

    $mascota = Mascotas::findOne($session['id_mascota']);
?>
	<div class="container">
		<div class="jumbotron hidden-xs">
			<?php
				if ($mascota->foto_cabecera_mod == 1) {
			?>
			<img src= <?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$mascota->id.'/'.$mascota->foto_cabecera.'"' ?> width="100%" height="300px" alt="">
			<?php				
				}else{
			?>
			<img src= <?= '"'.Yii::$app->params['urlBaseImg'].$mascota->foto_cabecera.'"' ?> width="100%" height="300px" alt="">
			<?php
				}
			?>			
		</div>
		<div class="row">
			<div class="col-lg-3">
				<?php
				if ($mascota->foto_perfil_mod == 1) {
				?>
				<div class="div-center">
				<img class="img-perfil" src= <?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$mascota->id.'/'.$mascota->foto_perfil.'"' ?> width="104px" height="104px" alt=""></div>
				<?php				
					}else{
				?>
				<div class="div-center">
				<img class="img-perfil" src=<?= '"'.Yii::$app->params['urlBaseImg'].$mascota->foto_perfil.'"' ?> width="104px" height="104px" alt=""></div>
				<?php
					}
				?>				
				<div class="list-group sidebar hidden-xs">
				  <?= Html::a('Mi Muro', ['mascotas/index'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mi Perfil', ['mascotas/perfil'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mis Amigos', ['mascotas/index'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mis Mensajes', ['mascotas/index'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mis Imagenes', ['mascotas/imagenes'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Buscar Mascotas', ['mascotas/buscarmascotas'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Cambiar Mascota', ['usuarios/vermascotas'],['class' => 'list-group-item']) ?>
				</div>
			</div>
			<div class="col-lg-9"><?= $content ?></div>
		</div>       
    </div>

<?php $this->endContent(); ?>