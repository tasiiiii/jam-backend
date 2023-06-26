<?php

namespace App\Jam\Task\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Board;
use App\Models\User;

class TaskCreateGate
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
    public function can(User $user, Board $board): void
    {
        $team = $this->teamRepository->getById($board->project_id);
        if (is_null($team)) {
            throw new ApplicationException('User can not create task');
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('User can not create task');
        }

        $role = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($role)) {
            throw new ApplicationException('User can not create task');
        }

        if ($role->permission === PermissionEnum::GUEST->value) {
            throw new ApplicationException('User can not create task');
        }
    }
}
