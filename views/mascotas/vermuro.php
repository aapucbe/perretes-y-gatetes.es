<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$this->title = 'Mi Muro';
?>
<div class="site-perfil border-box div-center" style="text-align: left">

    <?php $form = ActiveForm::begin([
        'id' => 'mimuro-form',
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, "id_mascota")->hiddenInput()->label(false) ?>                

    <?= $form->field($model, "contenido")->textarea(['placeholder' => '¿En que estás pensando?'])->label(false) ?>

    <?= $form->field($model, 'imagen')->fileInput()->label(false) ?>

    <?= Html::submitButton('Publicar', ['class' => 'btn btn-primary', 'name' => 'upload-post-button']) ?>

    <?php ActiveForm::end(); ?>

    <hr>

    <?php

        foreach ($posts as $row) {                   

    ?>

    <div class="row">

    <?php
        if ($row->imagen != '') {
    ?>
        <div class="col-lg12 col-md-12 col-sm-12">
            <img src="../../web/images/mascotas/mascota-<?= $row->id_mascota ?>/posts/<?= $row->imagen ?>" alt="foto post" width="80%" style="max-height: 400px">
        </div>
    <?php
        }
    ?>
        <div class="col-lg12 col-md-12 col-sm-12">
            <p style="margin-top:1em; margin-left:6em; margin-right:6em; text-align: justify;"><?= $row->contenido ?></p>
        </div>

        <div class="col-lg-12 cal-md-12 col-sm-12">
            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#id_post_<?= $row->id ?>">Eliminar</a>
                        <div class="modal fade" role="dialog" aria-hidden="true" id="id_post_<?= $row->id ?>">
                                  <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar</h4>
                                          </div>
                                          <div class="modal-body">
                                                <p>¿Realmente deseas eliminar este post?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <?= Html::beginForm(Url::toRoute("mascotas/eliminarpost")) ?>
                                                <input type="hidden" name="id_post" value="<?= $row->id ?>">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Eliminar</button>
                                          <?= Html::endForm() ?>
                                          </div>
                                        </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->  
        </div>        
    </div>
    <hr>

    <?php
        }
    ?>

    <div class="row">
        <div class="col-lg-12">
            <?= LinkPager::widget([
            "pagination" => $pages,
            ]); ?>
        </div>
    </div>

</div>