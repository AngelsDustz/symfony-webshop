<?php


namespace App\Controller\Admin;


use App\DTO\AdminDTO;
use App\Entity\Admin;
use App\Form\Type\AdminLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AdminController.
 *
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() instanceof Admin) {
            return $this->redirectToRoute('admin.dashboard');
        }

        $adminDTO           = new AdminDTO();
        $adminDTO->username = $authenticationUtils->getLastUsername();
        $form               = $this->createForm(AdminLoginType::class, $adminDTO);

        return $this->render(
            'admin/security/login.html.twig',
            [
                'form'  => $form->createView(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            ]
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('home');
    }
}