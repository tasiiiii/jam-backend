<?php

namespace App\Jam\Task\Repository;

use App\Models\Board;
use App\Models\BoardColumn;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    /**
     * @return Task|null
     */
    public function getById(int $id): ?object;
    public function getByBoardColumn(BoardColumn $boardColumn): Collection;
    public function countTasksInBoard(Board $board): int;
    public function getTasksWithoutBoardColumnInBoard(Board $board): Collection;
}
