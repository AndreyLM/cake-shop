<?php

namespace frontend\controllers;

use domain\managers\MenuManager;
use domain\managers\ProductManager;
use Yii;
use yii\helpers\Url;

class CatalogController extends DefaultController
{
    private $productManager;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function __construct($id, $module, MenuManager $menuManager, ProductManager $productManager, $config = [])
    {
        parent::__construct($id, $module, $menuManager, $config);
        $this->productManager = $productManager;
    }

    public function actionList($category = 0)
    {
        echo var_dump($this->headMenu); die;

        try {
            $products = $this->productManager->getProductsByCategory($category);
        } catch (\DomainException $exception) {
            $products = [];
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }


        return $this->render('list', [
            'products' => $products,
        ]);
    }

    public function actionView($id)
    {

        $product = $this->productManager->getProductById($id);

        return $this->render('view', [
            'product' => $product,
        ]);
    }

}
