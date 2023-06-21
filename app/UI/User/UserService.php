<?php

namespace App\UI\User;

use App\Models\User;

class UserService
{
    public function buildFullName(User $user): string
    {
        if ($user->middle_name) {
            return sprintf(
                '%s %s %s',
                $user->first_name,
                $user->middle_name,
                $user->last_name
            );
        }

        return sprintf(
            '%s %s',
            $user->first_name,
            $user->last_name
        );
    }
}
