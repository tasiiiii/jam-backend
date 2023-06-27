<?php

namespace App\Http\Controllers\API\v1\Project\Board\Task\Backlog;

use App\Http\Controllers\BaseController;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly BoardRepositoryInterface $boardRepository,
        private readonly TaskRepositoryInterface  $taskRepository,
        private readonly UserStatusChecker        $userStatusChecker,
        private readonly OutputService            $outputService,
        private readonly JsonResponseFactory      $jsonResponseFactory
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(int $boardId): JsonResponse
    {
        $this->userStatusChecker->checkCurrentUser();

        $board = $this->boardRepository->getById($boardId);
        if (is_null($board)) {
            return $this->jsonResponseFactory->error(message: 'Board not found', code: 403);
        }

        $tasks      = $this->taskRepository->getTasksWithoutBoardColumnInBoard($board);
        $outputData = [];
        foreach ($tasks as $task) {
            $outputData[] = $this->outputService->build($task);
        }

        return $this->jsonResponseFactory->success(
            'Backlog',
            [
                'tasks' => $outputData
            ]
        );
    }
}
