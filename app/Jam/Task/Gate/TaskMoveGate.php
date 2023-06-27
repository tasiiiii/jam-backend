<?php

namespace App\Jam\Task\Gate;

use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Models\BoardColumn;
use App\Models\User;

class TaskMoveGate
{
    public function __construct(
        private readonly BoardRepositoryInterface        $boardRepository,
        private readonly ProjectRepositoryInterface      $projectRepository,
        private readonly TeamRepositoryInterface         $teamRepository,
        private readonly TeamUserRepositoryInterface     $teamUserRepository,
        private readonly TeamUserRoleRepositoryInterface $teamUserRoleRepository
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function can(User $user, BoardColumn $boardColumn): void
    {
        $board = $this->boardRepository->getById($boardColumn->board_id);
        if (is_null($board)) {
            throw new ApplicationException('User can not move task in the board');
        }

        $project = $this->projectRepository->getById($board->project_id);
        if (is_null($project)) {
            throw new ApplicationException('User can not move task in the board');
        }

        $team = $this->teamRepository->getById($project->team_id);
        if (is_null($team)) {
            throw new ApplicationException('User can not move task in the board');
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (is_null($teamUser)) {
            throw new ApplicationException('User can not move task in the board');
        }

        $role = $this->teamUserRoleRepository->getById($teamUser->team_user_role_id);
        if (is_null($role)) {
            throw new ApplicationException('User can not move task in the board');
        }

        if ($role->permission === PermissionEnum::GUEST->value) {
            throw new ApplicationException('User can not move task in the board');
        }
    }
}
