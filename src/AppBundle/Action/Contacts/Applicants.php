<?php

namespace AppBundle\Action\Contacts;

use AppBundle\Datatable\ApplicantDatatable;
use Symfony\Component\HttpFoundation\Response;

class Applicants
{
    /**
     * @var ApplicantDatatable
     */
    private $datatable;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param ApplicantDatatable $datatable
     * @param \Twig_Environment $twig
     */
    public function __construct(ApplicantDatatable $datatable, \Twig_Environment $twig)
    {
        $this->datatable = $datatable;
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        $this->datatable->buildDatatable();

        return new Response($this->twig->render('AppBundle:Contacts:list.html.twig', [
            'datatable' => $this->datatable,
        ]));
    }
}
