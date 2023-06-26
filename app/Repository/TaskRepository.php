<?php

namespace App\Repository;

use App\Jam\Task\Repository\TaskRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
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
}
