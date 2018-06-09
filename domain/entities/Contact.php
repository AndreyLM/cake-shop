<?php

namespace domain\entities;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $text
*/

class Contact extends ActiveRecord
{

    public static function create($text): self
    {
        $contact = new static();
        $contact->text = $text;

        return $contact;
    }

    public function edit($text): void
    {
        $this->text = $text;
    }

    public static function tableName()
    {
        return '{{%shop_contacts}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'text' => 'Текст'
        ];
    }
}