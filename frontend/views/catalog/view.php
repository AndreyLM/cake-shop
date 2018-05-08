<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $product \domain\entities\Product */

use yii\helpers\Html;


$this->title = $product->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">
    <div class="row">
        <div class="col-md-5">

            <ul class="thumbnails">
                <?php foreach ($product->photos as $i => $photo): ?>
                    <?php if ($i == 0): ?>
                        <li>
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                                <img src="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>" alt="<?= Html::encode($product->name) ?>" />
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="image-additional">
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" title="HP LP3065">
                                <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="" />
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                
        </div>
        <div class="col-md-7">
            <h1><?= Html::encode($product->name) ?></h1>
            <p><i><?= Html::encode($product->title) ?></i></p>
            <p>Категория: <?= Html::encode($product->category->name) ?></p>
            <p><br>Описание:<br><?= $product->description ?></p>
            <p><br><br><b>Цена:<?= $product->price ?> UAH</b></p>
        </div>
    </div>
</div>

