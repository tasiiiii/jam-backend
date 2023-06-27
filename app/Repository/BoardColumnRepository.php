<?php

namespace App\Repository;

use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;
use Illuminate\Database\Eloquent\Collection;

class BoardColumnRepository implements BoardColumnRepositoryInterface
{
    /**
     * @return BoardColumn|null
     */
    public function getById(int $id): ?object
    {
        return BoardColumn::query()->find($id);
    }

    public function getByBoard(Board $board): Collection
    {
        return BoardColumn::query()
            ->where('board_id', '=', $board->id)
            ->get();
    }
}
