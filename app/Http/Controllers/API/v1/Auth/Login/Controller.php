<?php

namespace App\Http\Controllers\API\v1\Auth\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Auth\Login\Request;
use App\Jam\Auth\Action\LoginAction;
use App\Jam\Exception\ApplicationException;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/v1/auth/login",
 *     summary="Login user",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 *                 example={"email": "test@jam.local", "password": "12345678"}
 *             )
 *         )
 *     ),
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
 *                      @OA\Items(@OA\Property(property="token", type="string"), @OA\Property(property="expired_at", type="int"))
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
        private readonly LoginAction         $loginAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(Request $request): JsonResponse
    {
        try {
            $token = $this->loginAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success(
            'Login',
            [
                'token'      => $token->getToken(),
                'expired_at' => $token->getExpiredAt(),
            ]
        );
    }
}
