<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * HomeController Class.
 */
class HomeController extends AbstractController
{
    /**
     * FIXME this is a really ugly fix, we can do this better right?
     *
     * @Route("/", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function base(Request $request): Response
    {
        return $this->redirectToRoute(
            'home',
            ['_locale' => $request->getLocale()]
        );
    }

    /**
     * Home Action.
     *
     * @Route("/{_locale}", methods={"GET"}, name="home")
     *
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('general/home.html.twig');
    }
}
