<?php

namespace App\Repository;

use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Models\Team;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @return Team|null
     */
    public function getById(int $id): ?object
    {
        return Team::query()->find($id);
    }
}
