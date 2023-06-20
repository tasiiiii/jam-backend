<?php

namespace App\Repository;

use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?object
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }
}
