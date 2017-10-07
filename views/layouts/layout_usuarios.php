<?php $this->beginContent('@app/views/layouts/main.php'); 
	
	use yii\helpers\Html;
?>
	<div class="container">
		<div class="jumbotron hidden-xs">
			<?php
				if (Yii::$app->user->identity->foto_cabecera_mod == 1) {
			?>
			<img src= <?= '"'.Yii::$app->params['urlBaseImg'].'usuarios/usuario-'.Yii::$app->user->identity->id.'/'.Yii::$app->user->identity->foto_cabecera.'"' ?> width="100%" height="300px" alt="">
			<?php				
				}else{
			?>
			<img src= <?= '"'.Yii::$app->params['urlBaseImg'].Yii::$app->user->identity->foto_cabecera.'"' ?> width="100%" height="300px" alt="">
			<?php
				}
			?>			
		</div>
		<div class="row">
			<div class="col-lg-3">
				<?php
				if (Yii::$app->user->identity->foto_perfil_mod == 1) {
				?>
				<div class="div-center">
				<img class="img-perfil" src= <?= '"'.Yii::$app->params['urlBaseImg'].'usuarios/usuario-'.Yii::$app->user->identity->id.'/'.Yii::$app->user->identity->foto_perfil.'"' ?> width="104px" height="104px" alt=""></div>
				<?php				
					}else{
				?>
				<div class="div-center">
				<img class="img-perfil" src=<?= '"'.Yii::$app->params['urlBaseImg'].Yii::$app->user->identity->foto_perfil.'"' ?> width="104px" height="104px" alt=""></div>
				<?php
					}
				?>				
				<div class="list-group sidebar  hidden-xs">
				  <?= Html::a('Mi Perfil', ['usuarios/perfil','id' => base64_encode(Yii::$app->user->identity->id)],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mis Mascotas', ['usuarios/vermascotas'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Añadir Mascota', ['usuarios/crearmascota','id' => base64_encode(Yii::$app->user->identity->id)],['class' => 'list-group-item']) ?>
				  <?= Html::a('Buscar en adopción', ['usuarios/buscaradopcion'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Salir', ['site/logout'],['class' => 'list-group-item','data-method' => 'post']) ?>
				</div>
			</div>
			<div class="col-lg-9"><?= $content ?></div>
		</div>       
    </div>

<?php $this->endContent(); ?>