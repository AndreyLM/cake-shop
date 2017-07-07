<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $menu_model domain\forms\MenuForm */

/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($menu_model, 'parentId')->dropDownList($menu_model->parentMenusList()) ?>
            <?= $form->field($menu_model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($menu_model, 'type')->dropDownList($menu_model->statusList()) ?>
            <?= $form->field($menu_model, 'related_id')->textInput(['maxlength' => true]) ?>


        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
