<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class TenanciesMenuBuilder extends AbstractMenuBuilder
{
    /**
     * {@inheritdoc}
     */
    public function __construct(FactoryInterface $factory)
    {
        parent::__construct($factory);

        $this->menu->addChild('Tenancies', [
            'uri' => '#tenants',
        ]);

        $this->menu->addChild('Monies', [
            'uri' => '#monies',
        ]);

        $this->menu->addChild('Deposit', [
            'uri' => '#deposit',
        ]);

        $this->menu->addChild('Tenant Services', [
            'uri' => '#tenant-services',
        ]);

        $this->menu->addChild('Landlord Services', [
            'uri' => '#landlord-services',
        ]);

        $this->menu->addChild('Guarantor', [
            'uri' => '#guarantor',
        ]);
    }
}
