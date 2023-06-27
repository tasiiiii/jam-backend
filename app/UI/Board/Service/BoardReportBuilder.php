<?php

namespace App\UI\Board\Service;

use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;
use App\Models\Task;
use App\UI\Board\Dto\BoardReport\BoardReport;
use App\UI\Board\Dto\BoardReport\Column;
use App\UI\Board\Dto\BoardReport\Task as TaskData;
use App\UI\User\UserService;

class BoardReportBuilder
{
    public function __construct(
        private readonly BoardColumnRepositoryInterface $boardColumnRepository,
        private readonly TaskRepositoryInterface        $taskRepository,
        private readonly UserRepositoryInterface        $userRepository,
        private readonly UserService                    $userService
    )
    {}

    public function build(Board $board): BoardReport
    {
        $boardColumns = $this->boardColumnRepository->getByBoard($board);

        $boardReport = new BoardReport();
        $boardReport->setTitle($board->title);

        $columns = [];
        /** @var BoardColumn $boardColumn */
        foreach ($boardColumns as $boardColumn) {
            /** @var Task[] $tasks */
            $tasks            = $this->taskRepository->getByBoardColumn($boardColumn);
            $totalStoryPoints = 0;
            $reportTasks      = [];
            foreach ($tasks as $task) {
                $creator  = $this->userRepository->getById($task->creator_id);
                $executor = null;
                if ($task->executor_id) {
                    $executor = $this->userRepository->getById($task->executor_id);
                }

                $reportTasks[] = (new TaskData())
                    ->setTitle($task->title)
                    ->setCode($task->code)
                    ->setStoryPoint($task->story_point)
                    ->setCreator($creator ? $this->userService->buildFullName($creator) : null)
                    ->setExecutor($executor ? $this->userService->buildFullName($executor) : null);

                $totalStoryPoints += $task->story_point;
            }

            $columns[] = (new Column())
                ->setTitle($boardColumn->title)
                ->setTotalStoryPoints($totalStoryPoints)
                ->setTasks($reportTasks);
        }

        $boardReport->setColumns($columns);

        return $boardReport;
    }
}
