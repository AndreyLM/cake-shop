<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/18
 * Time: 5:44 AM
 */

namespace domain\forms;


use domain\entities\Contact;
use yii\base\Model;

class ContactForm extends Model
{
    public $id;
    public $text;


    public function __construct(Contact $contact = null, $config = [])
    {
        if ($contact) {
            $this->id = $contact->id;
            $this->text = $contact->text;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['text'], 'string']
        ];
    }
}