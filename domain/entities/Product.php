<?php

namespace domain\entities;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at', 'code', 'name'], 'required'],
            [['category_id', 'created_at', 'price'], 'integer'],
            [['meta_json'], 'string'],
            [['code', 'name', 'description'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
