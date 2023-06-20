<?php

namespace App\Http\Controllers\API\v1\Auth\Login;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Auth\Login\Request;
use App\Jam\Auth\Action\LoginAction;
use App\Jam\Exception\ApplicationException;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

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
