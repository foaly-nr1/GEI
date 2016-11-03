<?php

namespace AppBundle\Action;

use AppBundle\Datatable\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\Data\DatatableDataManager;
use Sg\DatatablesBundle\Datatable\Data\DatatableQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractDatatableList
{
    /**
     * @var AbstractDatatableView
     */
    protected $datatable;

    /**
     * @var DatatableDataManager
     */
    protected $dataManager;

    public function __construct(
        AbstractDatatableView $datatable,
        DatatableDataManager $dataManager
    )
    {
        $this->datatable = $datatable;
        $this->dataManager = $dataManager;
    }

    protected function addConditions(DatatableQuery $query, Request $request)
    {}

    public function __invoke(Request $request): Response
    {
        $this->datatable->buildDatatable();
        $query = $this->dataManager->getQueryFrom($this->datatable);

        $this->addConditions($query, $request);

        return $query->getResponse();
    }
}
