<?php

namespace domain\searches;

use yii\base\Model;

class ArticleSearch extends Model
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
            [['id', 'category_id'], 'integer'],
            [['category_id'], 'integer'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['content_intro', 'content'], 'string'],
            [['created_at', 'publishing_at'], 'integer'],
            ['slug', SlugValidator::class],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id']
        ];
    }
    public function search(array $params = [])
    {

    }
}