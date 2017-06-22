<?php

namespace domain\managers;

use domain\entities\Meta;
use domain\entities\Product;
use domain\forms\MetaForm;
use domain\forms\PhotosForm;
use domain\forms\ProductForm;
use domain\repositories\ProductRepository;

class ProductManager
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ProductForm $productForm, MetaForm $metaForm, $photos)
    {
        $product = Product::create(
            $productForm->category_id,
            $productForm->code,
            $productForm->name,
            $productForm->title,
            $productForm->description,
            $productForm->price,
            new Meta($metaForm->title, $metaForm->description, $metaForm->keywords),
            $productForm->order);

        $this->repository->save($product);

        foreach ($photos->files as $photo)
        {
            $product->addPhoto($photo);
        }



        return $product->id;

    }

    public function edit(ProductForm $productForm, MetaForm $metaForm, $photos)
    {
        /*
         * @var domain\entities\Product $product
         *public function edit($category_id, $created_at,
         * $publishing_at, $code, $name, $title, $description, $price,
                         $meta,$order, $status = self::ACTIVE)
         */

        $product = $this->repository->get($productForm->id);

        $product->edit($productForm->category_id,
            $productForm->created_at,
            $productForm->publishing_at,
            $productForm->code,
            $productForm->name,
            $productForm->title,
            $productForm->description,
            $productForm->price,
            new Meta($metaForm->title, $metaForm->description, $metaForm->keywords),
            $productForm->order);

        $this->repository->save($product);

        foreach ($photos->files as $photo)
        {
            $product->addPhoto($photo);
        }

        return $product->id;
    }

    public function makeActive($id)
    {
        $this->repository->makeActive($id);
    }

    public function makeUnActive($id)
    {
        $this->repository->makeUnActive($id);
    }

    public function save(Product $product)
    {
        $this->repository->save($product);
    }

    public function addPhotos($id, PhotosForm $photos)
    {
        $product = $this->repository->get($id);

        foreach ($photos->files as $photo) {
            $product->addPhoto($photo);
        }
    }

    public function remove($id)
    {
        $this->repository->remove($id);
    }
}