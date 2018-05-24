<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use domain\helpers\CategoryHelper;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $products[] \domain\entities\Product */
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
            <?php foreach ($products as $product):?>
                <div class="col-sm-3">

                    <div class="thumbnail product-list-item">
                        <a  href="<?= Url::to(['catalog/view', 'id' => $product->id])?>">
                            <?php if(isset($product->photos[0])) {?>

                                <p>

                                    <img class="product-list-img" src="<?= $product->photos[0]->getThumbFileUrl('file', 'thumb_products') ?>" alt="<?= Html::encode($product->name) ?>" />

                                </p>

                            <?php } else {?>
                                <a class="thumbnail" href="http://localhost/parvin/static/parvin_default.jpg">
                                    <img src="http://localhost/parvin/static/parvin_default.jpg" alt="<?= Html::encode($product->name) ?>" />
                                </a>
                            <?php } ?>

                            <p> <?= $product->name ?> </p>
                        </a>
                        <p>
                            <?= $product->price ?> UAH
                            <?= Html::a('Купить', ['cart/add', 'id' => $product->id], ['class' => 'btn pull-right custom-button'])?>
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
        <hr>
    </div>



