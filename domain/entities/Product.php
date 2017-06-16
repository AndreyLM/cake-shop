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
 * @property integer $published_at
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $meta_json
 * @property integer $status
 * @property Meta $meta
 *
 * @property Category $category
 */
class Product extends ActiveRecord
{

    private $meta;
    const ACTIVE = 1;
    const UN_ACTIVE = 2;

    public static function create($category_id, $code, $name, $description, $price, Meta $meta, $status = self::ACTIVE)
    {
        $product = new static();
        $product->category_id = $category_id;
        $product->created_at = time();
        $product->published_at = time();
        $product->code = $code;
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->meta = $meta;
        $product->status = $status;
        return $product;
    }

    public function edit($category_id, $code, $name, $description,
                         $price, Meta $meta, $status = self::ACTIVE)
    {
        $this->category_id = $category_id;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->meta = $meta;
        $this->status = $status;

    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function isActive()
    {
        return $this->status === self::ACTIVE;
    }

    public function makeActive()
    {
        $this->status = self::ACTIVE;
    }

    public function makeUnActive()
    {
        $this->status = self::UN_ACTIVE;
    }

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
