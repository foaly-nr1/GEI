<?php

namespace AppBundle\Action\Contacts;

use AppBundle\Entity\Tenant;
use AppBundle\Entity\User;
use AppBundle\Form\Handler\GenericFormHandler;
use AppBundle\Form\Type\TenantType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

class TenantsEditPersonal
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

    private $user;

    /**
     * @param EntityRepository $repository
     * @param FormFactoryInterface $factory
     * @param GenericFormHandler $handler
     * @param RouterInterface $router
     * @param \Twig_Environment $twig
     * @param FlashBagInterface $flashBag
     * @param User $user
     */
    public function __construct(
        EntityRepository $repository,
        FormFactoryInterface $factory,
        GenericFormHandler $handler,
        RouterInterface $router,
        \Twig_Environment $twig,
        FlashBagInterface $flashBag,
        User $user
    )
    {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->handler = $handler;
        $this->router = $router;
        $this->twig = $twig;
        $this->flashBag = $flashBag;
        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        if($request->attributes->has('tenantId')) {
            if (!($tenant = $this->repository->find($request->attributes->get('tenantId')))) {
                throw new NotFoundHttpException();
            }
            $formAction = $this->router->generate('app_tenants_edit_personal', [
                'tenantId' => $tenant->getId(),
            ]);
        } else {
            $tenant = (new Tenant())
                ->setNegotiator($this->user)
            ;
            $formAction = $this->router->generate('app_tenants_add_personal');
        }

        $form = $this->factory->create(TenantType::class, $tenant, [
            'action' => $formAction,
        ]);

        $success = $this->handler->handle($form, $request);

        if ($success && !$request->attributes->has('tenantId')) {
            /** @var Tenant $tenant */
            $tenant = $form->getData();
            return new RedirectResponse($this->router->generate('app_tenants_edit_personal', [
                'tenantId' => $tenant->getId(),
            ]), Response::HTTP_CREATED);
        }

        if ($success) {
            $this->flashBag->add('form-success', 'Tenant updated successfully');
        }

        return new Response($this->twig->render('AppBundle:Contacts:edit-personal.html.twig', [
            'form' => $form->createView(),
            'tenant' => $tenant,
        ]));
    }
}
