<?php

namespace App\Jam\Board\Repository;

use App\Models\Board;
use Illuminate\Database\Eloquent\Collection;

interface BoardColumnRepositoryInterface
{
    public function getByBoard(Board $board): Collection;
}
