<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Session;

AppAsset::register($this);

$this->title = 'Perretes y Gatetes';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $session = Yii::$app->session;
    $session->open();
    NavBar::begin([
        'brandLabel' => '<img src="../web/images/huella.png" class="img-responsive logo"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            ['label' => 'Iniciar sesión', 'url' => ['/site/login'],'visible' => Yii::$app->user->isGuest],
            ['label' => 'Registrarse', 'url' => ['/site/register'],'visible' => Yii::$app->user->isGuest],
            ['label' => 'Inicio', 'url' => ['usuarios/index'],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota'],
            ['label' => 'Mi Perfil', 'url' => ['usuarios/perfil','id' => base64_encode(Yii::$app->user->identity->id)],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Mascotas', 'url' => ['usuarios/vermascotas'],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Añadir Mascota', 'url' => ['usuarios/crearmascota','id' => base64_encode(Yii::$app->user->identity->id)],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Inicio', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota'],
            ['label' => 'Mi Muro', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mi Perfil', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Amigos', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Mensajes', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Imagenes', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Buscar Mascotas', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota'],
            ['label' => 'Cambiar Mascota', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota'],

            // Se añade ['data-method' => 'post'] porque la acción logout() solo puede ser tratada mediante este método
            ['label' => 'Salir ('.Yii::$app->user->identity->nombre.')', 'url' => ['/site/logout'],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota','linkOptions' => ['data-method' => 'post']]

        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
