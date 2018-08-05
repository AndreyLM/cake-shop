<?php

/* @var $this yii\web\View */
/* @var $models domain\entities\Article[] */


use yii\helpers\Html;

if(isset($models[0])) {

    $this->registerMetaTag([
        'name' => 'title',
        'content' => $models[0]->category->meta->title,
    ], 'description');

    $this->registerMetaTag([
        'name' => 'description',
        'content' => $models[0]->category->meta->description,
    ], 'description');

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $models[0]->category->meta->keywords,
    ], 'keywords');

    $this->title = $models[0]->category->title;
} else {
    $this->title = '';
}

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <h3><?= $this->title ?></h3>
    </div>
</div>
<?php foreach ($models as $model): ?>

    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($model->title) ?></h1>
            <?= Html::encode($model->content_intro) ?>
            <p><?= Html::a('Подробнее...', \yii\helpers\Url::to(['view', 'id'=>$model->id])) ?></p>
        </div>
    </div>

<?php endforeach; ?>
