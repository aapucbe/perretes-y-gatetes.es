<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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

            // Se añade ['data-method' => 'post'] porque la acción logout() solo puede ser tratada mediante este método
            ['label' => 'Salir ('.Yii::$app->user->identity->nombre.')', 'url' => ['/site/logout'],'visible' => !Yii::$app->user->isGuest,'linkOptions' => ['data-method' => 'post']]

            /*Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )*/
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
