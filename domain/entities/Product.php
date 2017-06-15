<?php

namespace domain\entities;

use domain\entities\behaviors\MetaBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_products".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $created_at
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $meta_json
 * @property Meta $meta
 *
 * @property Category $category
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_products}}';
    }

    public function behaviors()
    {

        return [
            MetaBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'meta_json' => 'Meta Json',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
