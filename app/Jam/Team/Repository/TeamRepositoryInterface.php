<?php

namespace App\Jam\Team\Repository;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface TeamRepositoryInterface
{
    /**
     * @return Team|null
     */
    public function getById(int $id): ?object;

    public function getByUser(User $user): Collection;
}
