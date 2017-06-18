<?php

namespace domain\entities;

use domain\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content_into
 * @property string $content
 * @property int $created_at
 * @property int $publishing_at
 * @property string $slug
 * @property Meta $meta
 * @property Category $category
 */
class Article extends ActiveRecord
{
    public $meta;

    public static function create($category_id, $title, $content_into, $content, $slug, Meta $meta): self
    {
        $article = new static();
        $article->category_id = $category_id;
        $article->title = $title;
        $article->content_into = $content_into;
        $article->content = $content;
        $article->created_at = time();
        $article->publishing_at = time();
        $article->slug = $slug;
        $article->meta = $meta;
        return $article;
    }

    public function edit($category_id, $title, $slug, $content_intro, $content, $publishing_at, Meta $meta): void
    {
        $this->category_id = $category_id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content_into = $content_intro;
        $this->content = $content;
        $this->publishing_at = $publishing_at;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->title;
    }

    public static function tableName(): string
    {
        return '{{%shop_articles}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}