<?php

namespace frontend\controllers;

use domain\managers\ArticleManager;
use domain\managers\ContactManager;
use domain\managers\MenuManager;
use domain\NotFoundException;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class ArticleController extends DefaultController
{
    /* @var \domain\managers\ArticleManager */
    private $articleManager;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function __construct($id, $module, MenuManager $menuManager,
                                ContactManager $contactManager, ArticleManager $articleManager, $config = [])
    {
        parent::__construct($id, $module, $menuManager, $contactManager, $config);
        $this->articleManager = $articleManager;
    }

    public function actionBlog($id)
    {
       $models = $this->articleManager->getArticlesByCategory($id);

        return $this->render('blog', [
            'models' => $models,
        ]);
    }

    public function actionView($id)
    {
        try {
            $model = $this->articleManager->getById($id);
        } catch (\DomainException $exception) {
            throw new NotFoundHttpException( $exception->getMessage() );
        }


        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionContentTable($id)
    {
        $models = $this->articleManager->getArticlesByCategory($id);

        return $this->render('blog', [
            'models' => $models,
        ]);
    }

}
