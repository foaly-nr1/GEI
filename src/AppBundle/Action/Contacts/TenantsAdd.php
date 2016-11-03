<?php

namespace AppBundle\Action\Contacts;

use Symfony\Component\HttpFoundation\Response;

class TenantsAdd
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render('AppBundle:Contacts:add.html.twig'));
    }
}
