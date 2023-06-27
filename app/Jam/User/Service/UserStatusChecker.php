<?php

namespace App\Jam\User\Service;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Enum\StatusEnum;
use App\Models\User;

class UserStatusChecker
{
    public function __construct(
        private readonly UserProviderInterface $userProvider
    )
    {}

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

    /**
     * @throws ApplicationException
     */
    public function checkCurrentUser(): void
    {
        $this->check($this->userProvider->getCurrentUser());
    }
}
