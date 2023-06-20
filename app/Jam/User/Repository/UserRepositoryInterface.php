<?php

namespace App\Jam\User\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @return User|null
     */
    public function getByEmail(string $email): ?object;
}
