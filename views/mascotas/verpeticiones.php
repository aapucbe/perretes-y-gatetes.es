<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Mis peticiones';
?>
<div class="div-center">
    <ul class="nav nav-tabs">
      <li><?= Html::a('Amigos', ['mascotas/veramigos']) ?></li>
      <li class="active"><?= Html::a('Peticiones', ['mascotas/verpeticiones']) ?></li>
    </ul>
</div>
<div class="site-perfil border-box div-center" style="text-align: left">

    <?php
        $i=1; 
        foreach($mascotas as $row):

        if ($i == 1 || $i == 4) {
    ?>
        <div class="row fila-amigos">
            <div class="col-lg-3 div-mascota border-box-mascota">
                <h4 style="margin-bottom: 0.6em"><?= $row->nombre ?></h4>

                <!-- Comprobamos si ha modificado la imagen por defecto -->
                <?php
                    if ($row->foto_perfil_mod == 1) {
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id.'/'.$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }else{
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }
                ?>
                <div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Aceptar', ['mascotas/aceptarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar"><?= Html::a('Rechazar', ['mascotas/rechazarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>                    
                </div>
            </div>
            <div class="col-lg-1"></div>
    <?php            
        }elseif ($i == 3 || $i == 6) 
        {
    ?>
            <div class="col-lg-3 div-mascota border-box-mascota">
                <h4 style="margin-bottom: 0.6em"><?= $row->nombre ?></h4>
                <!-- Comprobamos si ha modificado la imagen por defecto -->
                <?php
                    if ($row->foto_perfil_mod == 1) {
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id.'/'.$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }else{
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }
                ?>                
                <div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Aceptar', ['mascotas/aceptarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar"><?= Html::a('Rechazar', ['mascotas/rechazarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>                    
                </div>
            </div>
        </div>
    <?php
        }else{
    ?>
            <div class="col-lg-3 div-mascota border-box-mascota">
                <h4 style="margin-bottom: 0.6em"><?= $row->nombre ?></h4>
                <!-- Comprobamos si ha modificado la imagen por defecto -->
                <?php
                    if ($row->foto_perfil_mod == 1) {
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].'mascotas/mascota-'.$row->id.'/'.$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }else{
                ?>
                <img src=<?= '"'.Yii::$app->params['urlBaseImg'].$row->foto_perfil.'"' ?> alt="foto perfil mascota" class="img-responsive" width="90px" height="90px">
                <?php
                    }
                ?>                
                <div class="row" style="margin-bottom: 1em; margin-top: 0.6em">
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Aceptar', ['mascotas/aceptarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar"><?= Html::a('Rechazar', ['mascotas/rechazarpeticion','id_mascota' => $row->id],['class' => 'btn btn-default']) ?></div>                    
                </div>
            </div>
            <div class="col-lg-1"></div>
    <?php
        } 
        $i++;
        endforeach
    ?>
</div>