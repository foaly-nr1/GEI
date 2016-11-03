<?php

namespace AppBundle\Form\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractFormHandler
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
     * Called before entity is persisted.
     *
     * @param  object $entity
     * @return void
     */
    protected function prePersist(&$entity)
    {}

    /**
     * Called after entity is persisted.
     *
     * @param  object $entity
     * @return void
     */
    protected function postPersist($entity)
    {}

    /**
     * Passes the current request to the form and if valid, persists
     * the form data.
     *
     * @param  FormInterface $form    The form to be submitted
     * @param  Request       $request Current request
     * @return bool                   Whether form submission was successful
     */
    public function handle(FormInterface $form, Request $request): bool
    {
        if(!$request->isMethod('POST') && !$request->isMethod('PATCH')) {
            return false;
        }

        $form->handleRequest($request);

        if(!$form->isValid()) {
            return false;
        }

        $entity = $form->getData();

        $this->prePersist($entity);

        $this->em->persist($entity);
        $this->em->flush();

        $this->postPersist($entity);

        return true;
    }
}
