<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms;

use domain\entities\Article;
use domain\entities\Category;
use domain\validators\SlugValidator;
use yii\base\Model;



class ArticleForm extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $content_into;
    public $content;
    public $created_at;
    public $publishing_at;
    public $slug;


    public function rules(): array
    {
        return [
            [['title', 'slug', 'content_intro'], 'required'],
            [['category_id'], 'integer'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['content_intro', 'content'], 'string'],
            [['created_at', 'publishing_at'], 'integer'],
            ['slug', SlugValidator::class],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id']
        ];
    }

}