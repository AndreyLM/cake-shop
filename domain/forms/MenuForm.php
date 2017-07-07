<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms;

use domain\entities\Menu;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class MenuForm extends Model
{
    public $id;
    public $name;
    public $type;
    public $related_id;
    public $parentId;


    /**
     * MenuForm constructor.
     * @param Menu|null $menu
     * @param array $config
     */
    public function __construct(Menu $menu = null, $config = [])
    {
        if ($menu) {
            $this->name = $menu->name;
            $this->type = $menu->type;
            $this->related_id = $menu->related_id;
            $this->parentId = $menu->parent ? $menu->parent->id : null;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'related_id'], 'required'],
            [['name'], 'string'],
            [['type', 'related_id', 'parentId'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Название',
            'type' => 'Тип',
            'related_id' => 'ИД связи'
        ];
    }

    public function parentMenusList()
    {
        return ArrayHelper::map(Menu::find()->orderBy('lft')->asArray()->all(), 'id', function (array $menu) {
            return ($menu['depth'] > 1 ? str_repeat('-- ', $menu['depth'] - 1) . ' ' : '') . $menu['name'];
        });
    }

    public function statusList()
    {
        return [
            Menu::MENU_TYPE_CATEGORY => 'category',
            Menu::MENU_TYPE_ARTICLE => 'article',
            Menu::MENU_TYPE_PRODUCT => 'product',
            Menu::MENU_TYPE_CAT_PRODUCTS => 'product catalog'
        ];
    }

}