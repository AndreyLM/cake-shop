<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.06.17
 * Time: 8:17
 */
namespace domain\repositories;

use domain\entities\Article;
use domain\NotFoundException;

class ArticleRepository
{

    public function __construct()
    {

    }

    public function get($id)
    {
        if (!$article = Article::findOne($id)) {
            throw new NotFoundException('Article is not found.');
        }
        return $article;
    }

    public function getByCategoryId($id)
    {
        if(!$articles = Article::find()->where(['category_id' => $id])->all())
        {
            throw  new NotFoundException('Articles are not found');
        }

        return $articles;
    }

    public function save(Article $article)
    {
        if (!$article->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Article $article)
    {
        if (!$article->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}