<?php

namespace App\Jam\Board\Repository;

use App\Models\Board;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface BoardRepositoryInterface
{
    /**
     * @return Board|null
     */
    public function getById(int $id): ?object;
    public function getByProject(Project $project): Collection;
}
