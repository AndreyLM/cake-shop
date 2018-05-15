<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/15/18
 * Time: 10:43 AM
 */

namespace domain\forms\menu;


use domain\entities\menu\Menu;
use yii\base\Model;

class MenuItem extends Model
{
    const TYPE_ITEM_CONTAINER = '2';
    const TYPE_ITEM_TABLE_OF_CONTENT = '3';
    const TYPE_ITEM_BLOG_ARTICLES = '4';
    const TYPE_FAVORITE_ARTICLES = '5';
    const TYPE_ITEM_ARTICLE = '6';

    public $id;
    public $name;
    public $title;
    public $type;
    public $status;
    public $relation;
    public $depth;
    public $parentId;

    public function rules()
    {
        return [
            [['title', 'parentId'], 'required'],
            [['type', 'relation', 'depth', 'status', 'parentId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 32],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'title' => 'Название',
            'name' => 'Алиас',
            'type' => 'Тип',
            'relation' => 'Связь',
            'depth' => 'Depth',
            'status' => 'Статус',
            'parentId' => 'Родительский элемент',
        ];
    }
    public function getItemTypes()
    {
        return [
            self::TYPE_ITEM_CONTAINER => 'Контейнер',
            self::TYPE_ITEM_TABLE_OF_CONTENT => 'Таблица контента',
            self::TYPE_ITEM_BLOG_ARTICLES => 'Блог статьей',
            self::TYPE_FAVORITE_ARTICLES => 'Избранные статьи',
            self::TYPE_ITEM_ARTICLE => 'Статья',
        ];
    }
}