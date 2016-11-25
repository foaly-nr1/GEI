<?php

namespace AppBundle\Datatable;

use AppBundle\Entity\Tenant;

class ApplicantDatatable extends AbstractDatatableView
{
    public function buildDatatable(array $options = [])
    {
        parent::buildDatatable();

        $this->ajax->set([
            'url' => $this->router->generate('app_applicants_list'),
        ]);

        $this->options->set([
            'order' => [[3, 'asc']],
        ]);

        $this->columnBuilder
            ->add('id', 'column', [
                'title' => '#',
            ])
            ->add('firstName', 'column', [
                'title' => 'First name',
            ])
            ->add('lastName', 'column', [
                'title' => 'Last name',
            ])
            ->add('createdAt', 'datetime', [
                'title' => 'Created At',
            ])
            ->add(null, 'action', [
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => [
                    [
                        'route' => 'app_tenants_edit',
                        'route_parameters' => [
                            'tenantId' => 'id',
                        ],
                        'icon' => 'fa fa-pencil',
                        'attributes' => [
                            'class' => 'btn btn-primary btn-circle btn-lg',
                            'role' => 'button',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                        ],
                    ],
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return Tenant::class;
    }
}
