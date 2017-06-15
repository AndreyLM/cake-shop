<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.06.17
 * Time: 8:41
 */

namespace domain\managers;


use domain\repositories\CategoryRepository;

class CategoryManager
{
    private $category_repository;

    public function __construct(CategoryRepository $cat_repository)
    {
        $this->category_repository = $cat_repository;
    }

    public function getCategory($id)
    {
        return $this->category_repository->get($id);
    }

    public function saveCategory()
}