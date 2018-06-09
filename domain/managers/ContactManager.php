<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/18
 * Time: 5:47 AM
 */

namespace domain\managers;


use domain\entities\Contact;
use domain\forms\ContactForm;
use yii\helpers\ArrayHelper;

class ContactManager
{

    public function create(ContactForm $contactForm)
    {
        $contact = Contact::create($contactForm->text);

        $contact->save(false);

        return $contact->id;
    }

    public function getById($id)
    {
        return Contact::findOne($id);
    }

    public function getAll()
    {
        return Contact::find()->asArray()->all();
    }

    public function update(ContactForm $contactForm)
    {
        /* @var $contact Contact
         */

        $contact = Contact::findOne($contactForm->id);

        $contact->edit($contactForm->text);

        $contact->save();
    }

    public function remove($id)
    {
        $contact = Contact::findOne($id);
        $contact->delete();
    }

}