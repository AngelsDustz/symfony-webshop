<?php


namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserApiController.
 *
 * @Route("/api", name="api_")
 */
class UserApiController extends AbstractApiController
{
    /**
     * @Route("/v1/users", name="latest_users_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        return new JsonResponse('');
    }
}