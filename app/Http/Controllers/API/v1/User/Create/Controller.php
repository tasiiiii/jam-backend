<?php

namespace App\Http\Controllers\API\v1\User\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\User\Create\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Action\UserCreateAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

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
