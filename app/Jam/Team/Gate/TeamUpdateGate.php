<?php

namespace App\Jam\Team\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\User\Enum\StatusEnum;
use App\Models\Team;
use App\Models\User;

class TeamUpdateGate
{
    /**
     * @throws ApplicationException
     */
    public function can(User $user, Team $team): void
    {
        if ($user->status !== StatusEnum::Active->value) {
            throw new ApplicationException('Current user can not update a team - user is not active');
        }

        if ($team->creator_id !== $user->id) {
            throw new ApplicationException('Current user can not update a team - permission denied');
        }
    }
}
