<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Mis amigos';
?>
<div class="div-center">
    <ul class="nav nav-tabs">
      <li class="active"><?= Html::a('Amigos', ['mascotas/veramigos']) ?></li>
      <li><?= Html::a('Peticiones', ['mascotas/verpeticiones']) ?></li>
    </ul>
</div>
<div class="site-perfil border-box div-center" style="text-align: left">
        <div class="row">
          <h3><?= $msg ?></h3>
        </div>
    <?php
        $i=1; 
        foreach($amigos as $row):
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
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Ver', ['mascotas/verperfil','id_amigo' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar">
                        <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_mascota_<?= $row->id ?>">Eliminar</a>
                        <div class="modal fade" role="dialog" aria-hidden="true" id="id_mascota_<?= $row->id ?>">
                                  <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar mascota</h4>
                                          </div>
                                          <div class="modal-body">
                                                <p>¿Realmente deseas eliminar tu amistad con <?= $row->nombre ?>?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <?= Html::beginForm(Url::toRoute("mascotas/eliminaramigo"), "POST") ?>
                                                <input type="hidden" name="id_mascota" value="<?= $row->id ?>">
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
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Ver', ['mascotas/verperfil','id_amigo' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar">
                        <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_mascota_<?= $row->id ?>">Eliminar</a>
                        <div class="modal fade" role="dialog" aria-hidden="true" id="id_mascota_<?= $row->id ?>">
                                  <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar mascota</h4>
                                          </div>
                                          <div class="modal-body">
                                                <p>¿Realmente deseas eliminar tu amistad con <?= $row->nombre ?>?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <?= Html::beginForm(Url::toRoute("mascotas/eliminaramigo"), "POST") ?>
                                                <input type="hidden" name="id_mascota" value="<?= $row->id ?>">
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
                    <div class="col-lg-6 col-md-6 div-acceder"><?= Html::a('Ver', ['mascotas/verperfil','id_amigo' => $row->id],['class' => 'btn btn-default']) ?></div>
                    <div class="col-lg-6 col-md-6 div-eliminar">
                        <!-- Utilizamos un modal para que diga si esta seguro de eliminar la mascota -->               
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_mascota_<?= $row->id ?>">Eliminar</a>
                        <div class="modal fade" role="dialog" aria-hidden="true" id="id_mascota_<?= $row->id ?>">
                                  <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar mascota</h4>
                                          </div>
                                          <div class="modal-body">
                                                <p>¿Realmente deseas eliminar tu amistad con <?= $row->nombre ?>?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <?= Html::beginForm(Url::toRoute("mascotas/eliminaramigo"), "POST") ?>
                                                <input type="hidden" name="id_mascota" value="<?= $row->id ?>">
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
            <div class="col-lg-1"></div>
    <?php
        } 
        $i++;
        endforeach
    ?>
</div>