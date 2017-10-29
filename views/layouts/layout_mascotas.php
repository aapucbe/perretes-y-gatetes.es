<?php $this->beginContent('@app/views/layouts/main.php'); 
	
	use yii\helpers\Html;
	use yii\web\Session;
	use app\models\Mascotas;
	use app\models\Peticiones;
	use app\models\Mensajes;

	$session = Yii::$app->session;
    $session->open();

    $mascota = Mascotas::findOne($session['id_mascota']);
    $nombre = $mascota->nombre;

    # Comprobamos si la mascota tiene peticiones nuevas
    $peticiones = Peticiones::find()->where(['id_solicitado' => $session['id_mascota']])->all();
    $numPeticiones = count($peticiones);

    # Comprobamos si la mascota tiene mensajes nuevos
    $mensajes = Mensajes::find()->where(['id_receptor' => $session['id_mascota'], 'estado' => 'no leido'])->all();
    $numMensajes = count($mensajes);

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
				<div class="div-center hidden-xs">
				<img class="img-perfil" src= <?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$mascota->id.'/'.$mascota->foto_perfil.'"' ?> width="120px" height="120px" alt=""></div>
				<?php				
					}else{
				?>
				<div class="div-center hidden-xs">
				<img class="img-perfil" src=<?= '"'.Yii::$app->params['urlBaseImg'].$mascota->foto_perfil.'"' ?> width="120px" height="120px" alt=""></div>
				<?php
					}
				?>				
				<div class="list-group sidebar hidden-xs" style="margin-top:-1.4em">
				  <?= Html::a($nombre, ['mascotas/vermuro'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Mi Perfil', ['mascotas/perfil'],['class' => 'list-group-item']) ?>

				<?php
					if ($numPeticiones == 0) {
				?>
				  <?= Html::a('Mis Amigos', ['mascotas/veramigos'],['class' => 'list-group-item']) ?>
				<?php
					}else{
				?>
				  <?= Html::a('Mis Amigos <span class="aviso">'.$numPeticiones.'</span>', ['mascotas/veramigos'],['class' => 'list-group-item']) ?>
				<?php
				 	}
				?>
				<?php
					if ($numMensajes == 0) {
				?>
				  <?= Html::a('Mis Mensajes', ['mascotas/vermsjentrada'],['class' => 'list-group-item']) ?>
				<?php
					}else{
				?>
				  <?= Html::a('Mis Mensajes <span class="aviso">'.$numMensajes.'</span>', ['mascotas/vermsjentrada'],['class' => 'list-group-item']) ?>
				<?php
				   }
				?>

				  <?= Html::a('Mis Imagenes', ['mascotas/imagenes'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Buscar Mascotas', ['mascotas/buscarmascotas'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Buscar Cruce', ['mascotas/buscarcruce'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Adopciones', ['mascotas/verlistaadopciones'],['class' => 'list-group-item']) ?>
				  <?= Html::a('Cambiar Mascota', ['usuarios/vermascotas'],['class' => 'list-group-item']) ?>
				</div>
			</div>
			<div class="col-lg-9"><?= $content ?></div>
		</div>       
    </div>

<?php $this->endContent(); ?>