<?php

namespace App\Jam\Task\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\Task\Contract\TaskCreateDataInterface;
use App\Jam\Task\Gate\TaskCreateGate;
use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\Task;

class TaskCreateAction
{
    public function __construct(
        private readonly BoardRepositoryInterface $boardRepository,
        private readonly TaskRepositoryInterface  $taskRepository,
        private readonly TaskCreateGate           $taskCreateGate,
        private readonly UserStatusChecker        $userStatusChecker,
        private readonly UserProviderInterface    $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(TaskCreateDataInterface $data): void
    {
        $currentUser = $this->userProvider->getCurrentUser();
        $this->userStatusChecker->check($currentUser);

        $board = $this->boardRepository->getById($data->getBoardId());
        if (is_null($board)) {
            throw new ApplicationException('Project not found');
        }

        $this->taskCreateGate->can($currentUser, $board);

        $task              = new Task();
        $task->title       = $data->getTitle();
        $task->code        = 'CODE-' . $this->taskRepository->countTasksInBoard($board) + 1;
        $task->description = $data->getDescription();
        $task->creator_id  = $currentUser->id;
        $task->board_id    = $board->id;
        $task->save();
    }
}
