<?php

namespace App\Repository;

use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @return Team|null
     */
    public function getById(int $id): ?object
    {
        return Team::query()->find($id);
    }

    public function getByUser(User $user): Collection
    {
        return Team::query()
            ->join('team_users', 'teams.id', '=', 'team_users.team_id')
            ->where('team_users.user_id', '=', $user->id)
            ->get();
    }
}
