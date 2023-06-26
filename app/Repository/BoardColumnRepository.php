<?php

namespace App\Repository;

use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;
use Illuminate\Database\Eloquent\Collection;

class BoardColumnRepository implements BoardColumnRepositoryInterface
{
    public function getByBoard(Board $board): Collection
    {
        return BoardColumn::query()
            ->where('board_id', '=', $board->id)
            ->get();
    }
}
