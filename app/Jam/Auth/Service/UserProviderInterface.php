<?php

namespace App\Jam\Auth\Service;

use App\Models\User;

interface UserProviderInterface
{
    public function getCurrentUser(): User;
}
