<?php

namespace AppBundle\Datatable;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView as BaseAbstractDatatableView;

abstract class AbstractDatatableView extends BaseAbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = [])
    {
        $this->topActions->set([
            'actions' => [],
        ]);

        $this->features->set([
            'paging' => false,
            'scroll_y' => 'calc(100vh - 365px)',
        ]);

        $this->options->set([
            'dom' => 'lrtip',
            'stripe_classes' => [],
        ]);

        foreach(['topActions', 'features', 'options', 'callbacks', 'events', 'ajax'] as $property) {
            if(array_key_exists($property, $options)) {
                $this->$property->set($options[$property]);
            }
        }
    }
}
