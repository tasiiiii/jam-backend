<?php

namespace App\Repository;

use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @return Project|null
     */
    public function getById(int $id): ?object
    {
        return Project::query()->find($id);
    }

    public function getByTeam(Team $team): Collection
    {
        return Project::query()
            ->where('team_id', '=', $team->id)
            ->get();
    }
}
