<?php

/* @var $this \yii\web\View */
/* @var $content string */

use domain\helpers\MenuHelper;
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => '<img src="'.Yii::getAlias('@web/images/logo_tm.png').'" />',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar pull-right navbar-fixed-top navbar-custom',
        ],
    ]);
    $menuItems = [
        ['label' => 'Обратная связь', 'url' => ['/site/contact']],
    ];

    $result_array = array_merge(MenuHelper::getMenuItems(), $menuItems);

    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $result_array[] =  ['label' => '<span class="glyphicon glyphicon-user"></span> Login', 'url' => ['/site/login']];
    } else {
        $result_array[] =  ['label' => '<span class="glyphicon glyphicon-user"></span>', 'url' => 'http://localhost/parvin/backend/web/index.php'];
        $result_array[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $result_array,
    ]);
    NavBar::end();


    $carousel = [
        [
            'content' => '<img src="'.Yii::getAlias('@web/images/main_img3.jpg').'"/>',
            'caption' => '',
            'options' => []
        ],
    ];

    echo Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel slide', 'data-interval' => '8000'],
    ]);
    ?>










    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ПАРВИН <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
