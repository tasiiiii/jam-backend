<?php

namespace App\Http\Controllers\API\v1\Project\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Project\Create\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Project\Action\CreateProjectAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly CreateProjectAction $createProjectAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(Request $request): JsonResponse
    {
        try {
            $this->createProjectAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Project created');
    }
}
