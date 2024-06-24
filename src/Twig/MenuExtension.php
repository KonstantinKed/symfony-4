<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('main_menu', [$this, 'mainMenu']),
        ];
    }
    public function mainMenu(): array
    {
        return [
            [
                'path' => '/',
                'name' => 'Main page',
            ],
            [
                'path' => '/users',
                'name' => 'Users List',
            ],
        ];
    }
}