<?php

namespace App\Jam\Project\Repository;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface
{
    /**
     * @return Project|null
     */
    public function getById(int $id): ?object;
    public function getByTeam(Team $team): Collection;
}
