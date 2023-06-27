<?php

namespace App\Repository;

use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @return Task|null
     */
    public function getById(int $id): ?object
    {
        return Task::query()->find($id);
    }

    public function getByBoardColumn(BoardColumn $boardColumn): Collection
    {
        return Task::query()
            ->where('board_column_id', '=', $boardColumn->id)
            ->get();
    }

    public function countTasksInBoard(Board $board): int
    {
        return Task::query()
            ->where('board_id', '=', $board->id)
            ->count();
    }

    public function getTasksWithoutBoardColumnInBoard(Board $board): Collection
    {
        return Task::query()
            ->whereNull('board_column_id')
            ->where('board_id', '=', $board->id)
            ->get();
    }
}
