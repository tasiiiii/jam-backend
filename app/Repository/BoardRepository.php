<?php

namespace App\Repository;

use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Models\Board;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class BoardRepository implements BoardRepositoryInterface
{
    public function getByProject(Project $project): Collection
    {
        return Board::query()
            ->where('project_id', '=', $project->id)
            ->get();
    }
}
