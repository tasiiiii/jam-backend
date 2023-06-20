<?php

namespace App\Repository;

use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return User|null
     */
    public function getById(int $id): ?object
    {
        return User::query()->find($id);
    }

    /**
     * @return User|null
     */
    public function getByEmail(string $email): ?object
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }
}
