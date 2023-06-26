<?php

namespace App\Repository;

use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Models\Board;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class BoardRepository implements BoardRepositoryInterface
{
    /**
     * @return Board|null
     */
    public function getById(int $id): ?object
    {
        return Board::query()->find($id);
    }

    public function getByProject(Project $project): Collection
    {
        return Board::query()
            ->where('project_id', '=', $project->id)
            ->get();
    }
}
