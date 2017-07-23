<?php $this->beginContent('@app/views/layouts/main.php'); 
	
	use yii\helpers\Html;
?>

	<div class="container">
		<div class="jumbotron">
			<img src= <?= '"'.Yii::$app->params['urlBaseImg'].Yii::$app->user->identity->foto_cabecera.'"' ?> width="100%" height="300px" alt="">
		</div>
		<div class="row">
			<div class="col-lg-3">
				<img class="img-perfil" src=<?= '"'.Yii::$app->params['urlBaseImg'].Yii::$app->user->identity->foto_perfil.'"' ?> alt="">
				<ul class="list-group sidebar">
				  <li class="list-group-item"><?= Html::a('Mi Perfil', ['usuarios/index']) ?></li>
				  <li class="list-group-item"><?= Html::a('Mis Mascotas', ['usuarios/index']) ?></li>
				  <li class="list-group-item"><?= Html::a('Añadir Mascota', ['usuarios/index']) ?></li>
				  <li class="list-group-item"><?= Html::a('Salir', ['site/logout'],['data-method' => 'post']) ?></li>
				</ul>
			</div>
			<div class="col-lg-9"><?= $content ?></div>
		</div>       
    </div>

<?php $this->endContent(); ?>