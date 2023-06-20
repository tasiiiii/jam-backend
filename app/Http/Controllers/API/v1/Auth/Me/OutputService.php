<?php

namespace App\Http\Controllers\API\v1\Auth\Me;

use App\Models\User;

class OutputService
{
    public function build(User $user): array
    {
        return [
            'first_name'  => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name'   => $user->last_name,
            'email'       => $user->email,
        ];
    }
}
