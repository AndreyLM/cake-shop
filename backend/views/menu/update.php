<?php

/* @var $this yii\web\View */
/* @var $menu domain\entities\Menu */
/* @var $menu domain\forms\MenuForm */


$this->title = 'Редактировать меню: ' . $menu->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $menu->name, 'url' => ['view', 'id' => $menu->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'menu' => $menu,
    ]) ?>

</div>
