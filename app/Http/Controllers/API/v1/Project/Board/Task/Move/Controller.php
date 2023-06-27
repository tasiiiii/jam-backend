<?php

namespace App\Http\Controllers\API\v1\Project\Board\Task\Move;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Project\Board\Task\Move\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Task\Action\TaskMoveAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly TaskMoveAction      $taskMoveAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(int $taskId, Request $request): JsonResponse
    {
        $data = ($request->getData())
            ->setTaskId($taskId);

        try {
            $this->taskMoveAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Task moved');
    }
}
