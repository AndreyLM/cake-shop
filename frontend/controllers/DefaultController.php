<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/17/18
 * Time: 10:25 AM
 */

namespace frontend\controllers;

use domain\managers\MenuManager;
use yii\base\Module;
use yii\web\Controller;

class DefaultController extends Controller
{
    protected $menuManager;
    public $headMenu;


    public function __construct($id, Module $module, MenuManager $menuManager,array $config = [])
    {
        $this->menuManager = $menuManager;
        $this->customSettings();
        parent::__construct($id, $module, $config);
    }

    private function customSettings()
    {
        $this->headMenu = $this->menuManager->getHeaderMenu();
//        $setting = $this->configService->getOne(IConfigService::HEADER_MENU);
//        $this->headerMenu = $this->menuService->format(new NavMenuFormatter(), $setting->value);
    }
}