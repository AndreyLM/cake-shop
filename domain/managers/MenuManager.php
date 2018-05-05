<?php

namespace domain\managers;

use domain\entities\Menu;
use domain\forms\MenuForm;
use domain\repositories\MenuRepository;
use domain\repositories\ProductRepository;

class MenuManager
{
    private $menu;
    private $products;

    public function __construct(MenuRepository $menus, ProductRepository $products)
    {
        $this->menu = $menus;
        $this->products = $products;
    }

    public function create(MenuForm $form)
    {
        $parent = $this->menu->get($form->parentId);
        $menu = Menu::create(
            $form->name,
            $form->type,
            $form->related_id
        );

        $menu->appendTo($parent);
        $this->menu->save($menu);
        return $menu;
    }

    public function edit($id, MenuForm $form): void
    {
        $menu = $this->menu->get($id);
        $this->assertIsNotRoot($menu);
        $menu->edit(
            $form->name,
            $form->type,
            $form->related_id
        );

        if ($form->parentId !== $menu->parent->id) {
            $parent = $this->menu->get($form->parentId);
            $menu->appendTo($parent);
        }

        $this->menu->save($menu);
    }

    public function moveUp($id): void
    {
        $menu = $this->menu->get($id);
        $this->assertIsNotRoot($menu);
        if ($prev = $menu->prev) {
            $menu->insertBefore($prev);
        }
        $this->menu->save($menu);
    }

    public function moveDown($id): void
    {
        $menu = $this->menu->get($id);
        $this->assertIsNotRoot($menu);
        if ($next = $menu->next) {
            $menu->insertAfter($next);
        }
        $this->menu->save($menu);
    }

    public function remove($id): void
    {
        $menu = $this->menu->get($id);
        $this->assertIsNotRoot($menu);
        $this->menu->remove($menu);
    }

    private function assertIsNotRoot(Menu $menu)
    {
        if ($menu->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}