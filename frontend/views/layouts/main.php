<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;


AppAsset::register($this);

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
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

    <header>

        <div class="container-fluid">

            <div class="row" id="top-header">

<!--                SITE LOGO               -->
                <div class="col-md-2 logo">
                    <a href="https://lavar.com.ua/">
                            <img src="<?= Yii::getAlias("@web/images/logo-page.png") ?>"
                                 title="Интернет-магазин для кондитеров — Lavar" alt="Интернет-магазин для кондитеров — Lavar" />
                    </a>
                </div>

<!--                SEARCH / MENU-->
                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-4">

                            <a href="https://vk.com/vsedlyakonditerov" class="top-icons" target="_blank"><i class="fa fa-vk fa-lg"></i></a>

                            <a href="https://vk.com/vsedlyakonditerov" class="top-icons" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>

                            <a href="https://vk.com/vsedlyakonditerov" class="top-icons" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>

                            <a href="https://vk.com/vsedlyakonditerov" class="top-icons" target="_blank"><i class="fa fa-youtube fa-lg"></i></a>

                            <a href="https://vk.com/vsedlyakonditerov" class="top-icons" target="_blank"><i class="fa fa-odnoklassniki fa-lg"></i></a>

                        </div>

                        <div class="col-md-4" id="search">

                                    <i class="fa fa-search fa-lg"></i>
                                    <input type="text" name="filter_name" value="Поиск" onclick="this.value = '';" onkeydown="this.style.color = '#000000';">

                        </div>

                        <div class="col-md-4">


                            <div class="dropdown">
                                <a href="#" class="dropbtn">+38 (068) 554-80-80 <span class="icon-arrow-down"></span></a>
                                <div class="dropdown-content">
                                    <a href="#">+38 (095) 554-80-80</a>
                                    <a href="#">+38 (073) 554-80-80</a>
                                    <a href="#">ПН-ПТ 9:00-18:00</a>
                                    <a href="#">ТЕХ.ПЕРЕРЫВ <br>15:00-16:00</a>
                                    <a href="#">СБ 10:00-15:00</a>
                                    <a href="#">ВС — выходной!</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <nav class="navbar">
                                <div class="container-fluid">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#">Home</a></li>
                                        <li class='divider'></li>
                                        <li><a href="#">Page 1</a></li>
                                        <li class='divider'></li>
                                        <li><a href="#">Page 2</a></li>
                                        <li class='divider'></li>
                                        <li><a href="#">Page 3</a></li>
                                        <li class='divider'></li>
                                        <li><a href="#">Page 3</a></li>
                                    </ul>
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>

<!--                CART-->
                <div class="col-md-2" id="cart">
                        <a href="<?= Yii::?>"><span id="cart-total">Товаров: <?= \Yii::$app->cart->getCount().' <br>('.\Yii::$app->cart->getCost().' грн)' ?> </span></a>
                </div>
            </div>

            <div class="row" id="second-header">
                <div class="col-md-3">
                    <i class="fa fa-product-hunt fa-3x"></i>
                    Более 5 000 товаров
                </div>

                <div class="col-md-3">
                    <i class="fa fa-truck fa-3x"></i>
                    Бесплатная доставка<br>
                    <span>(при заказе от 1 000 грн)</span>
                </div>

                <div class="col-md-3">
                    <i class="fa fa-undo fa-3x"></i>
                    Возврат в течение 14 дней<br>
                    <span>(без вопросов и проблем)</span>
                </div>

                <div class="col-md-3">
                    <i class="fa fa-certificate fa-3x"></i>
                    Гарантия качества
                </div>

            </div>

        </div>

    </header>





    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CAKE-SHOP <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
