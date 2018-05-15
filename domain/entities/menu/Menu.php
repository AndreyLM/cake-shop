<?php

namespace domain\entities\menu;

use domain\entities\queries\MenuQuery;
use domain\forms\menu\MenuItem;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $type
 * @property integer $related_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $status

 *
 * @property Menu $parent
 * @property Menu[] $parents
 * @property Menu[] $children
 * @property Menu $prev
 * @property Menu $nextnew MenuManager()
 * @mixin NestedSetsBehavior
 */
class Menu extends ActiveRecord
{
    const MENU_TYPE_MENU = 0;
    const MENU_TYPE_CATEGORY = 1;
    const MENU_TYPE_ARTICLE = 2;
    const MENU_TYPE_PRODUCT = 3;
    const MENU_TYPE_CAT_PRODUCTS = 4;

    private $items = [];

    public static function create($name, $title, $type, $status, $related_id): self
    {
        $menu = new static();

        $menu->title = $title;
        $menu->name = $name;
        $menu->type = $type;
        $menu->status = $status;
        $menu->related_id = $related_id;

        return $menu;
    }

    public function addItem(Menu $item) {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function clearItems()
    {
        $this->items = [];
    }

    public function edit($name, $title, $type, $status, $related_id)
    {
        $this->name = $name;
        $this->type = $type;
        $this->title = $title;
        $this->status = $status;
        $this->related_id = $related_id;
    }


    public function getHeadingTile()
    {
        return $this->name;
    }

    public static function tableName()
    {
        return '{{%shop_menus}}';
    }

    public function behaviors()
    {
        return [
            NestedSetsBehavior::className(),
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function getType()
    {
        switch ($this->type){
            case self::MENU_TYPE_CATEGORY:
                return 'category';
            case self::MENU_TYPE_PRODUCT:
                return 'product';
            default :
                return 'article';
        }


    }


    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'name' => 'Алиас',
            'title' => 'Название',
            'type' => 'Тип',
            'related_id' => 'Ид связи',
            'status' => 'Статус',
        ];
    }

    public static function find()
    {
        return new MenuQuery(static::class);
    }
}