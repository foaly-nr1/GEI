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

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Dashboard', [
            'route' => 'app_dashboard',
        ])->setAttribute('icon', 'home');

        $menu->addChild('Contacts', [
            'route' => 'app_applicants',
        ])->setAttribute('icon', 'users');

        $menu->addChild('Properties', [
            'uri' => '#properties',
        ])->setAttribute('icon', 'building-o');

        $menu->addChild('Tenancies', [
            'uri' => '#tenancies',
        ])->setAttribute('icon', 'key');

        $menu->addChild('Management', [
            'uri' => '#management',
        ])->setAttribute('icon', 'wrench');

        $menu->addChild('Diaries', [
            'uri' => '#diaries',
        ])->setAttribute('icon', 'calendar-o');

        $menu->addChild('HR', [
            'uri' => '#hr',
        ])->setAttribute('icon', 'black-tie');

        $menu->addChild('Reports', [
            'uri' => '#reports',
        ])->setAttribute('icon', 'bar-chart');

        return $menu;
    }
}
