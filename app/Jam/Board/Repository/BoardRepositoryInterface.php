<?php

namespace App\Jam\Board\Repository;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface BoardRepositoryInterface
{
    public function getByProject(Project $project): Collection;
}
