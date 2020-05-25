<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Factory\AdminFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class DashboardController.
 *
 * @Route("/admin", name="admin_")
 */
class DashboardController extends AbstractController
{
    /**
     * @var AdminFactory
     */
    private $adminFactory;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(AdminFactory $adminFactory)
    {
        $this->adminFactory = $adminFactory;
    }

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
        // or logout and let Symfony handle it.
        if (true === \in_array($path, ['login', 'logout'])) {
            return $this->forward(
                sprintf(
                    '%s::%s',
                    LoginController::class,
                    $path
                )
            );
        }

        $user = $this->getUser();

        if (false === ($user instanceof Admin)) {
            throw new BadRequestHttpException();
        }

        $user = $this->adminFactory->createDTO($user);

        return $this->render('admin/dashboard/index.html.twig', [
            'user' => $this->getSerializer()->serialize(
                $user,
                'json',
                [
                    AbstractNormalizer::IGNORED_ATTRIBUTES => ['password'],
                ]
            ),
        ]);
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer(): SerializerInterface
    {
        if (null === $this->serializer) {
            $encoders       = [new JsonEncoder()];
            $normalizers    = [new ObjectNormalizer()];

            $this->serializer = new Serializer($normalizers, $encoders);
        }

        return $this->serializer;
    }
}
