<?php

namespace App\Jam\Task\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Task\Contract\TaskMoveDataInterface;
use App\Jam\Task\Gate\TaskMoveGate;
use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;

class TaskMoveAction
{
    public function __construct(
        private readonly TaskRepositoryInterface        $taskRepository,
        private readonly BoardColumnRepositoryInterface $boardColumnRepository,
        private readonly TaskMoveGate                   $taskMoveGate,
        private readonly UserStatusChecker              $userStatusChecker,
        private readonly UserProviderInterface          $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(TaskMoveDataInterface $taskMoveData): void
    {
        $currentUser = $this->userProvider->getCurrentUser();
        $this->userStatusChecker->check($currentUser);

        $targetBoardColumn = $this->boardColumnRepository->getById($taskMoveData->getTargetBoardColumnId());
        if (is_null($targetBoardColumn)) {
            throw new ApplicationException('Board column not found');
        }

        $task = $this->taskRepository->getById($taskMoveData->getTaskId());
        if (is_null($task)) {
            throw new ApplicationException('Task not found');
        }

        $this->taskMoveGate->can($currentUser, $targetBoardColumn);

        $task->board_column_id = $targetBoardColumn->id;
        $task->save();
    }
}
