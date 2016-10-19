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
    }

    /**
     * @return ItemInterface
     */
    public function createApplicantsMenu()
    {
//        $this->addActionButton([
//            'route' => 'app_tenants_add',
//        ]);

        return $this->menu;
    }
}
