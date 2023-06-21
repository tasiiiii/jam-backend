<?php

namespace App\Jam\Team\Repository;

use App\Models\Team;
use App\Models\TeamUserRole;

interface TeamUserRoleRepositoryInterface
{
    /**
     * @return TeamUserRole|null
     */
    public function getById(int $id): ?object;

    /**
     * @return TeamUserRole|null
     */
    public function getByIdAndTeam(int $id, Team $team): ?object;
}
