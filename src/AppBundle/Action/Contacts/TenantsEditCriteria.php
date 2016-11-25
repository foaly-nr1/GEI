<?php

namespace AppBundle\Action\Contacts;

use AppBundle\Entity\Tenant;
use AppBundle\Form\Handler\GenericFormHandler;
use AppBundle\Form\Handler\PropertyCriteriaFormHandler;
use AppBundle\Form\Type\PropertyCriteriaType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

class TenantsEditCriteria
{
    /**
     * Contact repository
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
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * @param EntityRepository $repository
     * @param FormFactoryInterface $factory
     * @param PropertyCriteriaFormHandler $handler
     * @param RouterInterface $router
     * @param \Twig_Environment $twig
     * @param FlashBagInterface $flashBag
     */
    public function __construct(
        EntityRepository $repository,
        FormFactoryInterface $factory,
        PropertyCriteriaFormHandler $handler,
        RouterInterface $router,
        \Twig_Environment $twig,
        FlashBagInterface $flashBag
    )
    {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->handler = $handler;
        $this->router = $router;
        $this->twig = $twig;
        $this->flashBag = $flashBag;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        if (!$request->attributes->has('tenantId')) {
            throw new BadRequestHttpException();
        }

        /** @var Tenant $tenant */
        if (!($tenant = $this->repository->find($request->attributes->get('tenantId')))) {
            throw new NotFoundHttpException();
        }

        $form = $this->factory->create(PropertyCriteriaType::class, $tenant->getCriteria(), [
            'action' => $this->router->generate('app_tenants_edit_criteria', [
                'tenantId' => $tenant->getId(),
            ]),
        ]);

        $success = $this->handler->handle($form, $request, $tenant);

        if ($success) {
            $this->flashBag->add('form-success', 'Criteria updated successfully');
        }

        return new Response($this->twig->render('AppBundle:Contacts:edit-criteria.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
