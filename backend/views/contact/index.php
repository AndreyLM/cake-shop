<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $models [] */


$this->title = 'Контакти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Создать контакт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            
                <?php foreach ($models as $model): ?>
                    <div class="row">
                        <div class="col-md-4"><?= $model['text'] ?></div>
                        <div class="col-md-8">
                            <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'id' => $model['id']] )?>
                            <?= Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model['id']] )?>
                            <?= Html::a('<i class="fa fa-trash"></i>',
                                ['delete', 'id' => $model['id']],
                                ['data' => [
                                    'method' => 'post',
                                    'confirm' => 'Вы подтверждаете удаление?'
                            ]])?>
                        </div>
                    </div>
                <?php endforeach; ?>
            
        </div>
    </div>
</div>
