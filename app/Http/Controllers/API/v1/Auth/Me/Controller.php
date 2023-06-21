<?php

namespace App\Http\Controllers\API\v1\Auth\Me;

use App\Http\Controllers\BaseController;
use App\Jam\Auth\Service\UserProviderInterface;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/v1/auth/me",
 *     summary="Get current user",
 *     @OA\Response(
 *         response=200,
 *         description="Success",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      property="message",
 *                      type="string"
 *                 ),
 *                 @OA\Property(
 *                      property="data",
 *                      type="array",
 *                      @OA\Items(
 *                          @OA\Property(property="first_name", type="string"),
 *                          @OA\Property(property="middle_name", type="string"),
 *                          @OA\Property(property="last_name", type="string"),
 *                          @OA\Property(property="email", type="string")
 *                      )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                      property="message",
 *                      type="string"
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class Controller extends BaseController
{
    public function __construct(
        private readonly UserProviderInterface $userProvider,
        private readonly OutputService         $outputService,
        private readonly JsonResponseFactory   $jsonResponseFactory
    )
    {}

    public function run(): JsonResponse
    {
        return $this->jsonResponseFactory->success(
            'Current user',
            $this->outputService->build(
                $this->userProvider->getCurrentUser()
            )
        );
    }
}
