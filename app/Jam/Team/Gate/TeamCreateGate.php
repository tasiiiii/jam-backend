<?php

namespace App\Jam\Team\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\User\Enum\StatusEnum;
use App\Models\User;

class TeamCreateGate
{
    /**
     * @throws ApplicationException
     */
    public function can(User $user): void
    {
        if ($user->status !== StatusEnum::Active->value) {
            throw new ApplicationException('Current user can not create a team - user is not active');
        }
    }
}
