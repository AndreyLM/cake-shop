<?php

/* @var $this yii\web\View */
/* @var $article domain\entities\Article */
/* @var $article_model domain\forms\ArticleForm */
/* @var $meta_model domain\forms\ArticleForm */

$this->title = 'Update Article: ' . $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $article->title, 'url' => ['view', 'id' => $article->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'article_model' => $article_model,
        'meta_model' => $meta_model,
    ]) ?>

</div>
