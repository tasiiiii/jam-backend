<?php

namespace App\Jam\Project\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Team;
use App\Models\User;

class ProjectCreateGate
{
    public function __construct(
        private readonly TeamUserRepositoryInterface     $teamUserRepository,
        private readonly TeamUserRoleRepositoryInterface $teamUserRoleRepository
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function can(User $user, Team $team): void
    {
        if ($user->id === $team->creator_id) {
            return;
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('User can not create project');
        }

        $role = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($role)) {
            throw new ApplicationException('User can not create project');
        }

        if (in_array($role->permission, [PermissionEnum::GOD_MODE, PermissionEnum::ADMIN])) {
            throw new ApplicationException('User can not create project');
        }
    }
}
