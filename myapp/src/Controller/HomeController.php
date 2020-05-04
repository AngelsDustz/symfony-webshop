<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * HomeController Class.
 */
class HomeController extends AbstractController
{
    /**
     * Home Action.
     *
     * @Route("/", methods={"GET"}, name="home")
     *
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('general/home.html.twig');
    }
}
