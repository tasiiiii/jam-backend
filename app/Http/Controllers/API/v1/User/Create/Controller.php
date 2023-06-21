<?php

namespace App\Http\Controllers\API\v1\User\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\User\Create\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Action\UserCreateAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/v1/users",
 *     summary="Create user",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="first_name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="middle_name",
 *                     oneOf={
 *                     	   @OA\Schema(type="string"),
 *                     	   @OA\Schema(type="null"),
 *                     }
 *                 ),
 *                 @OA\Property(
 *                     property="last_name",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 *                 example={"first_name": "Test", "middle_name": "Testovich", "last_name": "Testov", "email": "test@jam.local", "password": "12345678"}
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
        private readonly UserCreateAction    $userCreateAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(Request $request): JsonResponse
    {
        try {
            $this->userCreateAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success(
            'User created'
        );
    }
}
