<?php

namespace App\Repository;

use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * @return Project|null
     */
    public function getById(int $id): ?object
    {
        return Project::query()->find($id);
    }
}
