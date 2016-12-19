<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class ContactsMenuBuilder extends AbstractMenuBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(FactoryInterface $factory)
    {
        parent::__construct($factory);

        $this->menu->addChild('Applicants', [
            'route' => 'app_applicants',
        ]);

        $this->menu->addChild('Tenants', [
            'uri' => '#tenants',
        ]);

        $this->menu->addChild('Guarantors', [
            'uri' => '#guarantors',
        ]);

        $this->menu->addChild('Landlords', [
            'uri' => '#guarantors',
        ]);

        $this->menu->addChild('Contractors', [
            'uri' => '#contractors',
        ]);

        $this->menu->addChild('Vendors', [
            'uri' => '#vendors',
        ]);

        $this->menu->addChild('Suppliers', [
            'uri' => '#suppliers',
        ]);
    }

    /**
     * @return ItemInterface
     */
    public function createApplicantsMenu()
    {
        $this->addActionButton([
            'route' => 'app_tenants_add',
        ]);

        return $this->menu;
    }
}
