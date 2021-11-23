<?php
// src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private $factory;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navDesign');
        $menu->addChild('Accueil', ['route' => 'home'])->setLinkAttribute('class', 'fa fa-home');;
        $menu->addChild('Articles', ['route' => 'article_index']);
        $menu->addChild('Catégories', ['route' => 'category_index']);
        $menu->addChild('Tags', ['route' => 'tag_index']);



        // ... add more children
        return $menu;
    }
}

