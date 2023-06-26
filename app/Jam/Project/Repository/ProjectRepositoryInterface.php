<?php

namespace App\Jam\Project\Repository;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    /**
     * @return Project|null
     */
    public function getById(int $id): ?object;
}
