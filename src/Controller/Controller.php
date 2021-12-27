<?php

declare(strict_types=1);

namespace Jeschek\DragSort\Controller;

use Bolt\Extension\ExtensionController;
use Bolt\Utils\Sanitiser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class Controller extends ExtensionController
{
    /**
     * @Route("/extensions/dragsort/{name}", name="dragsort_example")
     */
    public function index($name = 'foo', Sanitiser $sanitiser, Environment $twig): Response
    {
        $context = [
            'title' => 'DragSort Test',
            'name' => $name,
        ];

        return $this->render('@dragsort/page.html.twig', $context);
    }
}
