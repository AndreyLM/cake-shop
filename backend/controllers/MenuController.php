<?php

namespace backend\controllers;

use domain\forms\MenuForm;
use domain\managers\MenuManager;
use domain\searches\MenuSearch;
use Yii;
use domain\entities\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MenuController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\MenuManager $service
     * @param array $config
     */
    public function __construct($id, $module, MenuManager $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'menu' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */

    public function actionCreate()
    {
        $menu_form = new MenuForm();

        if ($menu_form->load(Yii::$app->request->post()) && $menu_form->validate())
        {
            try {
                $category = $this->service->create($menu_form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'menu_model' => $menu_form,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $menu = $this->findModel($id);

        $menu_form = new MenuForm($menu);

        if ($menu_form->load(Yii::$app->request->post()) && $menu_form->validate()) {
            try {
                $this->service->edit($menu->id, $menu_form);
                return $this->redirect(['view', 'id' => $menu->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'menu_model' => $menu_form,
            'menu' => $menu,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveUp($id)
    {
        $this->service->moveUp($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveDown($id)
    {
        $this->service->moveDown($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
