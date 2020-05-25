<?php

declare(strict_types=1);

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
     * @Route("/v1/users", name="v1_users_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        return new JsonResponse('');
    }
}
