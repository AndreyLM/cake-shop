<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $recommendedProducts[] \domain\entities\Product */
/* @var $latestProducts[] \domain\entities\Product */
?>

<?php
 Modal::begin([
    'header' => '<h4>КОРЗИНА ПОКУПОК</h4>',
     'id' => 'modal',
     'size' => 'modal-lg'
 ]);

 echo '<div id="modalContent"></div>';
 Modal::end();
?>

    <div class="product-list">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h1 class="product-list-heading"><i class="fa fa-thumbs-up"></i> Рекомендуем </h1>

            </div>
        </div>
        <hr>
        <div class="row">
            <?php foreach ($recommendedProducts as $recommendedProduct):?>
                <div class="col-sm-3">

                    <div class="thumbnail product-list-item">
                        <a  href="<?= Url::to(['catalog/view', 'id' => $recommendedProduct->id])?>">
                            <?php if(isset($recommendedProduct->photos[0])) {?>

                                <p>

                                    <img class="product-list-img" src="<?= $recommendedProduct->photos[0]->getThumbFileUrl('file', 'thumb_products') ?>" alt="<?= Html::encode($recommendedProduct->name) ?>" />

                                </p>

                            <?php } else {?>
                                <a class="thumbnail" href="http://localhost/parvin/static/parvin_default.jpg">
                                    <img src="http://localhost/parvin/static/parvin_default.jpg" alt="<?= Html::encode($recommendedProduct->name) ?>" />
                                </a>
                            <?php } ?>

                            <p> <?= $recommendedProduct->name ?> </p>
                        </a>
                        <p>
                            <?= $recommendedProduct->price ?> UAH
                            <?= Html::button('Купить',
                                [
                                    'value'=> yii::$app->urlManager->createAbsoluteUrl(['/cart/add', 'id' => $recommendedProduct->id]),
                                    'class' => 'btn pull-right custom-button',
                                    'id' => 'modalButton'
                                ])?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h1 class="product-list-heading"><i class="fa fa-plane"></i> Новые поступленния</h1>
            </div>
        </div>


        <div class="row">
            <?php foreach ($latestProducts as $latestProduct):?>
                <div class="col-sm-3">

                    <div class="thumbnail product-list-item">
                        <a  href="<?= Url::to(['catalog/view', 'id' => $latestProduct->id])?>">
                            <?php if(isset($latestProduct->photos[0])) {?>

                                <p>
                                    <img class="product-list-img" src="<?= $latestProduct->photos[0]->getThumbFileUrl('file', 'thumb_products') ?>" alt="<?= Html::encode($recommendedProduct->name) ?>" />

                                </p>

                            <?php } else {?>
                                <a class="thumbnail" href="http://localhost/parvin/static/parvin_default.jpg">
                                    <img src="http://localhost/parvin/static/parvin_default.jpg" alt="<?= Html::encode($latestProduct->name) ?>" />
                                </a>
                            <?php } ?>

                            <p> <?= $latestProduct->name ?> </p>
                        </a>
                        <p>
                            <?= $latestProduct->price ?> UAH
                            <?= Html::a('Купить', ['cart/add', 'id' => $latestProduct->id], ['class' => 'btn pull-right custom-button'])?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <hr>
    </div>



