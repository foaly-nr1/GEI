<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MainMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Dashboard', [
            'route' => 'app_dashboard',
        ])->setExtra('icon', 'home');

        $menu->addChild('Contacts', [
            'route' => 'app_applicants',
        ])->setExtra('icon', 'users');

        $menu->addChild('Properties', [
            'uri' => '#properties',
        ])->setExtra('icon', 'building-o');

        $menu->addChild('Tenancies', [
            'uri' => '#tenancies',
        ])->setExtra('icon', 'key');

        $menu->addChild('Management', [
            'uri' => '#management',
        ])->setExtra('icon', 'wrench');

        $menu->addChild('Diaries', [
            'uri' => '#diaries',
        ])->setExtra('icon', 'calendar-o');

        $menu->addChild('HR', [
            'uri' => '#hr',
        ])->setExtra('icon', 'black-tie');

        $menu->addChild('Reports', [
            'uri' => '#reports',
        ])->setExtra('icon', 'bar-chart');

        return $menu;
    }
}
