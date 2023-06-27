<?php

namespace App\Jam\Board\Repository;

use App\Models\Board;
use App\Models\BoardColumn;
use Illuminate\Database\Eloquent\Collection;

interface BoardColumnRepositoryInterface
{
    /**
     * @return BoardColumn|null
     */
    public function getById(int $id): ?object;
    public function getByBoard(Board $board): Collection;
}
