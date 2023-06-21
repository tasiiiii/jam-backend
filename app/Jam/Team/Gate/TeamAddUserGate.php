<?php

namespace App\Jam\Team\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Team;
use App\Models\User;

class TeamAddUserGate
{
    public function __construct(
        private readonly TeamUserRepositoryInterface     $teamUserRepository,
        private readonly TeamUserRoleRepositoryInterface $teamUserRoleRepository
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function can(Team $team, User $user): void
    {
        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('The user is not part of the team');
        }

        $teamUserRole = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($teamUserRole)) {
            throw new ApplicationException('The user is not part of the team');
        }

        if (!in_array($teamUserRole->permission, [PermissionEnum::GOD_MODE->value, PermissionEnum::ADMIN->value])) {
            throw new ApplicationException('The user cannot add another user to the team');
        }
    }
}
