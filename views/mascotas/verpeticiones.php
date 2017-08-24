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