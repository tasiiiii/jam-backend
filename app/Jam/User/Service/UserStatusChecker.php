<?php

namespace App\Jam\User\Service;

use App\Jam\Exception\ApplicationException;
use App\Jam\User\Enum\StatusEnum;
use App\Models\User;

class UserStatusChecker
{
    /**
     * @throws ApplicationException
     */
    public function check(User $user): void
    {
        if ($user->status === StatusEnum::NotActive->value) {
            throw new ApplicationException('User is not activated');
        }

        if ($user->status === StatusEnum::Banned->value) {
            throw new ApplicationException('User banned');
        }
    }
}
