<?php

namespace domain\managers;

use domain\entities\menu\Menu;
use domain\forms\menu\MenuForm;
use domain\forms\menu\MenuItemForm;
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

    /*-----------------MENU---------------------*/
    public function getMenu($id)
    {
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

    public function remove($id): void
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);
        $this->menuRepository->remove($menu);
    }

    /*-----------------MENU-ITEM---------------------*/

    public function createMenuItem(MenuItemForm $menuItemForm)
    {

        /* @var $parent Menu */
        $parent = $this->menuRepository->get($menuItemForm->parentId);



        $menu = Menu::create(
            $menuItemForm->name,
            $menuItemForm->title,
            $menuItemForm->type,
            $menuItemForm->status,
            $menuItemForm->relation
        );

        $menu->appendTo($parent);
        $this->menuRepository->save($menu);

        return $menu;
    }

    public function editMenuItem($id, MenuItemForm $form)
    {
        /* @var $menu Menu */
        $menu = $this->menuRepository->get($id);

        $this->assertIsNotRoot($menu);

        $menu->edit(
            $form->name,
            $form->title,
            $form->type,
            $form->status,
            $form->relation
        );

        if ($form->parentId !== $menu->parent->id) {
            /* @var $parent Menu*/
            $parent = $this->menuRepository->get($form->parentId);
            $menu->appendTo($parent);
        }

        $this->menuRepository->save($menu);
    }

    /*-------------------------helpers----------------------*/
    public function getRootMenuItem(Menu $menu)
    {
        return $this->menuRepository->getRootMenuItem($menu->id);
    }

    public function getItemsList($menuId)
    {
        /* @var $menu Menu */
        $menu = $this->getMenu($menuId);

        $items = [];
        $items[$menu->id] = $menu->title;

        foreach ($menu->children as $child) {
            $items[$child->id] = str_repeat('-', $child->depth-1). $child->title;
        }

        return $items;
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

    private function assertIsNotRoot(Menu $menu)
    {
        if ($menu->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}