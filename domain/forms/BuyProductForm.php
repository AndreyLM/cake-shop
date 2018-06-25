<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/25/18
 * Time: 5:34 PM
 */

namespace domain\forms;


use yii\base\Model;

class BuyProductForm extends Model
{
    public $id;
    public $size;

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['size'], 'string'],
          ];
    }
}