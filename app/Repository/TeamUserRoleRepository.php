<?php

namespace App\Repository;

use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Team;
use App\Models\TeamUserRole;

class TeamUserRoleRepository implements TeamUserRoleRepositoryInterface
{
    /**
     * @return TeamUserRole|null
     */
    public function getById(int $id): ?object
    {
        return TeamUserRole::query()->find($id);
    }

    /**
     * @return TeamUserRole|null
     */
    public function getByIdAndTeam(int $id, Team $team): ?object
    {
        return TeamUserRole::query()
            ->where('id', '=', $id)
            ->where('team_id', '=', $team->id)
            ->first();
    }
}
