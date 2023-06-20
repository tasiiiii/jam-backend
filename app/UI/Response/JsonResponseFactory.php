<?php

namespace App\UI\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseFactory
{
    public function success(string $message = '', array $data = []): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ]);
    }

    public function error(string $message = '', array $data = [], int $status = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ], $status);
    }
}
