<?php

namespace domain\helpers;

use domain\entities\Article;

use domain\entities\Category;
use domain\entities\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class ProductHelper
{
    public static function statusList(): array
    {
        return [
            Product::UN_ACTIVE => 'UnActive',
            Product::ACTIVE => 'Active',
        ];
    }

    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status, $id = null, $makeUrl = true)
    {
        switch ($status) {
            case Article::UN_ACTIVE:
                $class = 'label label-default';
                $url = Url::to(['product/make-active', 'id'=>$id]);
                break;
            case Article::ACTIVE:
                $class = 'label label-success';
                $url = Url::to(['product/make-un-active', 'id'=>$id]);
                break;
            default:
                $class = 'label label-default';
                $url = Url::to(['product/make-active', 'id'=>$id]);
        }

        if ($makeUrl) {
            return Html::a(Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
                'class' => $class,
            ]), $url);
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);

//        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
//            'class' => $class,
//        ]);
    }

    public static function getCategoryList()
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
}