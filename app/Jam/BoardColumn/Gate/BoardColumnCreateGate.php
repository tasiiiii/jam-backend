<?php

namespace App\Jam\BoardColumn\Gate;

use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\Board;
use App\Models\User;

class BoardColumnCreateGate
{
    public function __construct(
        private readonly ProjectRepositoryInterface      $projectRepository,
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
        $project = $this->projectRepository->getById($board->project_id);
        if (is_null($project)) {
            throw new ApplicationException('User can not created board column');
        }

        $team = $this->teamRepository->getById($project->team_id);
        if (is_null($team)) {
            throw new ApplicationException('User can not created board column');
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('User can not create project');
        }

        $role = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($role)) {
            throw new ApplicationException('User can not create project');
        }

        if ($role->permission === PermissionEnum::GUEST->value) {
            throw new ApplicationException('User can not create project');
        }
    }
}
