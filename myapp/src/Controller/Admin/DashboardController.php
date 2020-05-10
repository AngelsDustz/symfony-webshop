<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController.
 *
 * @Route("/admin", name="admin_")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/{path}", name="dashboard", methods={"GET"})
     *
     * @param string $path
     *
     * @return Response
     */
    public function dashboard(string $path = ''): Response
    {
        // Since this is the SPA path, check if we match login
        // If we match login show login else do SPA things.
        if ('login' === $path) {
            return $this->forward(
                sprintf(
                    '%s::%s',
                    LoginController::class,
                    'login'
                )
            );
        }

        // Same for logout. We want symfony to handle it, not us.
        if ('logout' === $path) {
            return $this->forward(
                sprintf(
                    '%s::%s',
                    LoginController::class,
                    'logout'
                )
            );
        }

        return $this->render('admin/dashboard/index.html.twig');
    }
}