<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use domain\helpers\CategoryHelper;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $products[] \domain\entities\Product */
?>

<div class="row">
    <div class="col-md-3">
        <h3>Категории</h3>
        <ul class="category-list">
            <?php
            $categories = CategoryHelper::getProductCategoriesList();
            foreach ($categories as $id => $category):?>
                <a href="<?= Url::to(['site/products', 'category' => $id])?>"><li><?= $category?></li></a>
            <?php endforeach;?>
        </ul>

    </div>
    <div class="col-md-9 product-list">
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
                            <?= Html::a('Купить', ['cart/add', 'id' => $product->id], ['class' => 'btn btn-success pull-right'])?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

