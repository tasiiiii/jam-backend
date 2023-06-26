<?php

namespace App\Jam\Board\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Project;
use App\Models\User;

class BoardCreateGate
{
    public function __construct(
        private readonly TeamRepositoryInterface         $teamRepository,
        private readonly TeamUserRepositoryInterface     $teamUserRepository,
        private readonly TeamUserRoleRepositoryInterface $teamUserRoleRepository
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function can(User $user, Project $project): void
    {
        $team = $this->teamRepository->getById($project->team_id);
        if (is_null($team)) {
            throw new ApplicationException('User can not create board');
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('User can not create board');
        }

        $role = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($role)) {
            throw new ApplicationException('User can not create board');
        }

        if (in_array($role->permission, [PermissionEnum::GOD_MODE, PermissionEnum::ADMIN])) {
            throw new ApplicationException('User can not create board');
        }
    }
}
