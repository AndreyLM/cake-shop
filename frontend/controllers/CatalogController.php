<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use domain\managers\ProductManager;
use domain\repositories\ProductRepository;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class CatalogController extends \yii\web\Controller
{
    private $service;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function __construct($id, $module, ProductManager $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionList($category = 0)
    {

        try {
            $products = $this->service->getProductsByCategory($category);
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

        $product = $this->service->getProductById($id);

        return $this->render('view', [
            'product' => $product,
        ]);
    }


}
