<?php

namespace App\Services;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;


class MenuBuilder

{

    public function __construct(
        protected FactoryInterface $factory,
        protected Security $security
    )
    {
    }

    public function createMainMenu(RequestStack $requestStack): ItemInterface
    {
        $liCss = ['class' => 'nav-item'];
        $aCss = ['class' => 'nav-link'];

        $menu = $this->factory->createItem('root')->setChildrenAttributes(['class' => 'nav']);

        $menu->addChild('Головна', ['route' => 'app_main'])->setAttributes($liCss)->setLinkAttributes($aCss);
//        if ($this->security->getUser()) {
            $menu->addChild('Користувачі', ['route' => 'app_users_list'])->setAttributes($liCss)->setLinkAttributes($aCss);
            $menu->addChild('Скорочення', ['route' => 'short_codes_stats'])->setAttributes($liCss)->setLinkAttributes($aCss);
//        }

        return $menu;
    }

}