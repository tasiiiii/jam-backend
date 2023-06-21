<?php

namespace App\Repository;

use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;

class TeamUserRepository implements TeamUserRepositoryInterface
{
    /**
     * @return TeamUser|null
     */
    public function getByTeamAndUser(Team $team, User $user): ?object
    {
        return TeamUser::query()
            ->where('team_id', '=', $team->id)
            ->where('user_id', '=', $user->id)
            ->first();
    }
}
