<?php

namespace App\Http\Controllers\API\v1\Project\Board\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Project\Board\Create\Request;
use App\Jam\Board\Action\BoardCreateAction;
use App\Jam\Exception\ApplicationException;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly BoardCreateAction   $boardCreateAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(int $projectId, Request $request): JsonResponse
    {
        $data = ($request->getData())
            ->setProjectId($projectId);

        try {
            $this->boardCreateAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Board created');
    }
}
