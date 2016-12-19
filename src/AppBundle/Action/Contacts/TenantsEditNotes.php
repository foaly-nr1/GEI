<?php

namespace AppBundle\Action\Contacts;

use AppBundle\Entity\Tenant;
use AppBundle\Entity\TenantNote;
use AppBundle\Form\Handler\GenericFormHandler;
use AppBundle\Form\Type\TenantNoteType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

class TenantsEditNotes
{
    /**
     * Tenant repository.
     *
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var FormFactoryInterface
     */
    private $factory;

    /**
     * @var GenericFormHandler
     */
    private $handler;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param EntityRepository     $repository Tenant repository
     * @param FormFactoryInterface $factory
     * @param GenericFormHandler   $handler
     * @param RouterInterface      $router
     * @param \Twig_Environment    $twig
     */
    public function __construct(
        EntityRepository $repository,
        FormFactoryInterface $factory,
        GenericFormHandler $handler,
        RouterInterface $router,
        \Twig_Environment $twig
    ) {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->handler = $handler;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        /** @var Tenant $tenant */
        if (!($tenant = $this->repository->find($request->attributes->get('tenantId')))) {
            throw new NotFoundHttpException();
        }

        $note = (new TenantNote())
            ->setTenant($tenant)
        ;

        $form = $this->factory->create(TenantNoteType::class, $note, [
            'action' => $this->router->generate('app_tenants_edit_notes', [
                'tenantId' => $tenant->getId(),
            ]),
        ]);

        $this->handler->handle($form, $request);

        return new Response($this->twig->render('AppBundle:Contacts:edit-notes.html.twig', [
            'tenant' => $tenant,
            'form' => $form->createView(),
        ]));
    }
}
