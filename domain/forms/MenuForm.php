<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms;


use yii\base\Model;



class MenuForm extends Model
{
    const TYPE_MENU = '1';

    public $id;
    public $title;
    public $name;
    public $status;
    public $type;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
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
            'id' => 'ID',
            'title' => 'Title',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }
}