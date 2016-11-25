<?php

namespace AppBundle\Form\Handler;

use AppBundle\Entity\Tenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class PropertyCriteriaFormHandler
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Passes the current request to the form and if valid, persists
     * the form data.
     *
     * @param  FormInterface $form The form to be submitted
     * @param  Request $request Current request
     * @param Tenant $tenant
     * @return bool Whether form submission was successful
     */
    public function handle(FormInterface $form, Request $request, Tenant $tenant): bool
    {
        if (!$request->isMethod('POST') && !$request->isMethod('PATCH')) {
            return false;
        }

        $form->handleRequest($request);

        if(!$form->isValid()) {
            return false;
        }

        $this->em->persist($tenant);
        $this->em->flush();

        return true;
    }
}
