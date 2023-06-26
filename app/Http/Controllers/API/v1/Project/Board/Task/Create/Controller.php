<?php

namespace App\Http\Controllers\API\v1\Project\Board\Task\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Task\Create\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Task\Action\TaskCreateAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly TaskCreateAction    $taskCreateAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(int $boardId, Request $request): JsonResponse
    {
        $data = ($request->getData())
            ->setBoardId($boardId);

        try {
            $this->taskCreateAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Task created');
    }
}
