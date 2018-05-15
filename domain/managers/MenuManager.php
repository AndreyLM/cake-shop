<?php

namespace domain\managers;

use domain\entities\menu\Menu;
use domain\forms\menu\MenuForm;
use domain\repositories\MenuRepository;
use domain\repositories\ProductRepository;

class MenuManager
{
    private $menuRepository;
    private $productRepository;

    public function __construct(MenuRepository $menuRepository, ProductRepository $productRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->productRepository = $productRepository;
    }

    public function getMenu($id, $withItems = false)
    {

        if (!$withItems) {
            return $this->menuRepository->get($id);
        }


        return $this->menuRepository->get($id);
    }

    public function createMenu(MenuForm $form)
    {
        /* @var $parent Menu */
        $parent = $this->menuRepository->get(1);

        $menu = Menu::create(
            $form->name,
            $form->title,
            Menu::MENU_TYPE_MENU,
            $form->status,
            0
        );

        $menu->appendTo($parent);
        $this->menuRepository->save($menu);

        return $menu;
    }

    public function editMenu($id, MenuForm $form)
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);

        $menu->edit(
            $form->name,
            $form->title,
            Menu::MENU_TYPE_MENU,
            $form->status,
            0
        );

        $this->menuRepository->save($menu);
    }

    public function getMenuItems($menuId)
    {
        $fullMenu = [];
        $fullMenu['menu'] = $this->getMenu($menuId);
        $fullMenu['items'] = $this->getMenuItems($menuId);

        return $fullMenu;
    }

    public function create(MenuForm $form)
    {
        /* @var $menu Menu */
        $parent = $this->menuRepository->get($form->parentId);

        $menu = Menu::create(
            $form->name,
            $form->title,
            $form->type,
            $form->related_id
        );

        $menu->appendTo($parent);
        $this->menuRepository->save($menu);

        return $menu;
    }

    public function edit($id, MenuForm $form): void
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);

        $menu->edit(
            $form->name,
            $form->type,
            $form->related_id
        );

        if ($form->parentId !== $menu->parent->id) {
            $parent = $this->menuRepository->get($form->parentId);
            $menu->appendTo($parent);
        }

        $this->menuRepository->save($menu);
    }

    public function moveUp($id): void
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);

        if ($prev = $menu->prev) {
            $menu->insertBefore($prev);
        }

        $this->menuRepository->save($menu);
    }

    public function moveDown($id): void
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);

        if ($next = $menu->next) {
            $menu->insertAfter($next);
        }

        $this->menuRepository->save($menu);
    }

    public function remove($id): void
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);
        $this->menuRepository->remove($menu);
    }
//
//    private function getMenuItems($menuId)
//    {
//        return $this->menuRepository->getMenuItems($menuId);
//    }

    private function assertIsNotRoot(Menu $menu)
    {
        if ($menu->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}