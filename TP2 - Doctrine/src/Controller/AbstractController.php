<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

abstract class AbstractController
{
    private RouterInterface $router;

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    public function render($templateName, $data = []): Response
    {
        $loader = new FilesystemLoader(__DIR__ . "/../../templates");
        $twig = new Environment($loader, [
            'cache' => __DIR__ . "/../../var/cache/",
            'debug' => true,
        ]);

        $twig->addFunction(new TwigFunction('path', [$this->router, 'generate']));

        return new Response($twig->render($templateName, $data));
    }

    public function redirectTo($path):Response{
        return new RedirectResponse($path);
    }

    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }
}
