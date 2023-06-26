<?php

namespace App\Jam\Task\Repository;

use App\Models\Board;
use App\Models\BoardColumn;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function getByBoardColumn(BoardColumn $boardColumn): Collection;
    public function countTasksInBoard(Board $board): int;
}
