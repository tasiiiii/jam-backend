<?php

namespace App\Jam\Team\Repository;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;

interface TeamUserRepositoryInterface
{
    /**
     * @return TeamUser|null
     */
    public function getByTeamAndUser(Team $team, User $user): ?object;
}
