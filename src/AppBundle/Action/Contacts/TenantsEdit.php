<?php

namespace AppBundle\Action\Contacts;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

class TenantsEdit
{
    /**
     * Tenant repository.
     *
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param EntityRepository  $repository Tenant repository
     * @param RouterInterface   $router
     * @param \Twig_Environment $twig
     */
    public function __construct(
        EntityRepository $repository,
        RouterInterface $router,
        \Twig_Environment $twig
    ) {
        $this->repository = $repository;
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
        if (!($tenant = $this->repository->find($request->attributes->get('tenantId')))) {
            throw new NotFoundHttpException();
        }

        return new Response($this->twig->render('AppBundle:Contacts:edit.html.twig', [
            'tenant' => $tenant,
        ]));
    }
}
