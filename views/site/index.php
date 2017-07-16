<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Perretes y Gatetes';
?>
<div class="site-index">
    <div class="container div-top">
        <div class="row">
            <div class="col-lg-6 div-center img-index">
                <img src="../web/images/perro-y-gato.jpg" class="img-rounded"/>
            </div>
            <div class="col-lg-6 div-center border-box">
                <h1>¡Regístrate!</h1>
                <h3>Sólo te llevará un minuto</h3>
                <br>
                <div class="row">
                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'layout' => 'horizontal',
                        /*'fieldConfig' => [
                            'labelOptions' => ['class' => 'col-md-1 control-label'],
                        ],*/
                    ]); ?>

                        <?= $form->field($model, 'nombre')->textInput() ?>

                        <?= $form->field($model, 'apellidos')->textInput() ?>

                        <?= $form->field($model, 'email')->textInput() ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'repeat_password')->passwordInput() ?>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                            </div>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
