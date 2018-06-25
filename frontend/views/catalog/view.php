<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $product \domain\entities\Product */

use domain\forms\BuyProductForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = $product->name;
$this->params['breadcrumbs'][] = $this->title;
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

<div class="product-view">

    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::encode($product->category->description) ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1 class="product-title">
                <?= Html::encode($product->title) ?>
            </h1>
        </div>
    </div>
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
        <p class="col-md-7">
            <h3><?= Html::encode($product->name) ?></h3>
            <p>Код: <?= Html::encode($product->code) ?></p>
            <p>Категория: <?= Html::encode($product->category->name) ?></p>
            <p></p>
            <p></p>
            <p class="product-price"><b>Цена: <?= $product->price ?> UAH</b></p>

            <?php
            $model = new BuyProductForm();

            $form = ActiveForm::begin([
                  'method' => 'post',
                  'action' => ['cart/add-product'],
            ]); ?>

                    <?= $form->field($model, 'id')->hiddenInput(['value' => $product->id])
                        ->label(false) ?>

                    <?= $form->field($model, 'size')->dropDownList(['0' =>'0', '1'=>'400', '2'=>'500'])?>

            <p>
                <?= Html::submitButton('Купить',
                    [
                            'class' => 'btn custom-button modalButton',
                            'value' => yii::$app->urlManager->createAbsoluteUrl(['cart/add', 'id' => $product->id])
                    ]) ?>
            </p>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>Описание:</p>
            <p><?= $product->description ?></p>
        </div>
    </div>
</div>

