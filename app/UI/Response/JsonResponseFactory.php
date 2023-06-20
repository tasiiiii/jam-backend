<?php

namespace App\UI\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseFactory
{
    public function success(array $data = []): JsonResponse
    {
        return new JsonResponse($data);
    }

    public function error(array $data = [], int $status = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return new JsonResponse($data, $status);
    }
}
