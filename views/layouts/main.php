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
    <!-- Estilos CSS para lightbox Lokesh Dhakar-->
    <link href="../web/lib/lightbox/src/css/lightbox.css" rel="stylesheet">
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
            ['label' => 'Buscar adopción', 'url' => ['usuarios/buscaradopcion'],'visible' => !Yii::$app->user->isGuest && $session['rol'] != 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Inicio', 'url' => ['mascotas/index'],'visible' => $session['rol'] == 'mascota'],
            ['label' => 'Mi Muro', 'url' => ['mascotas/vermuro'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mi Perfil', 'url' => ['mascotas/perfil'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Amigos', 'url' => ['mascotas/veramigos'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Mensajes', 'url' => ['mascotas/vermsjentrada'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Mis Imagenes', 'url' => ['mascotas/imagenes'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Adopciones', 'url' => ['mascotas/verlistaadopciones'],'visible' => $session['rol'] == 'mascota','options' => ['class' => 'visible-xs-inline']],
            ['label' => 'Buscar Mascotas', 'url' => ['mascotas/buscarmascotas'],'visible' => $session['rol'] == 'mascota'],
            ['label' => 'Buscar Cruce', 'url' => ['mascotas/buscarcruce'],'visible' => $session['rol'] == 'mascota'],
            ['label' => 'Cambiar Mascota', 'url' => ['usuarios/vermascotas'],'visible' => $session['rol'] == 'mascota'],

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
<!-- JQuery -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>-->
<!-- JS par lightbox Lokesh Dhakar -->
<script src="../web/lib/lightbox/src/js/lightbox.js"></script>
</body>
</html>
<?php $this->endPage() ?>
