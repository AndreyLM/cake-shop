<?php


namespace domain\repositories;


use domain\entities\Product;
use domain\NotFoundException;

class ProductRepository
{
    public function get($id)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException("Can't find category");
        }
        return $product;
    }

    public function save(Product $product)
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }

    }

    public function remove(Product $product)
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }

    }

}