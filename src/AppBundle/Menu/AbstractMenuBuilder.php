<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

abstract class AbstractMenuBuilder
{
    /**
     * @var ItemInterface
     */
    protected $menu;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->menu = $factory->createItem('root');
    }

    /**
     * @param array $options
     * @param string $label
     * @param string $icon
     * @return AbstractMenuBuilder
     */
    protected function addActionButton(array $options, $label = 'Add', $icon = 'plus'): AbstractMenuBuilder
    {
        // can use routeParameters option, too
        $this->menu->addChild($label, $options)
            ->setExtra('icon', $icon)
            ->setAttribute('class', 'pull-right')
            ->setLinkAttributes([
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'class' => 'btn btn-primary',
            ])
        ;

        return $this;
    }
}
