<?php

/* @var $this yii\web\View */
/* @var $menu_model domain\forms\MenuForm */


$this->title = 'Создать пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'menu_model' => $menu_model,

    ]) ?>

</div>
