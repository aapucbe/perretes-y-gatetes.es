<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Mensajes recibidos';
?>

<div class="div-center">
	<ul class="nav nav-tabs">
	  <li><?= Html::a('Entrada', ['mascotas/vermsjentrada']) ?></li>
	  <li><?= Html::a('Enviados', ['mascotas/vermsjenviados']) ?></li>
	  <li><?= Html::a('Enviar mensaje', ['mascotas/enviarmensaje']) ?></li>
	</ul>
</div>
<div class="border-box div-center" style="padding: 15px">
	<div class="row">
   <div class="col-lg-6 col-md-6 col-sm-12 cabecera-msjunico">
     <p><strong>De: </strong><?= $mensaje->nombre_emisor ?></p>
   </div>
    <div class="col-lg-6 col-md-6 col-sm-12 cabecera-msjunico">
      <p><strong>Para: </strong><?= $mensaje->nombre_receptor ?></p>
    </div> 
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 cabecera-msjunico">
      <p><strong>Fecha de envío: </strong><?= $mensaje->fecha_envio ?></p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 cabecera-msjunico">
      <p><strong>Asunto: </strong><?= $mensaje->asunto ?></p>
    </div>
  </div>
  <hr>
  <div class="row contenido-msjunico">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <p><?= $mensaje->contenido ?></p>
    </div>    
  </div>
</div>