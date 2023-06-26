<?php

namespace App\Jam\Team\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Contract\TeamAddUserDataInterface;
use App\Jam\Team\Gate\TeamAddUserGate;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\TeamUser;
use App\Repository\TeamUserRepository;

class TeamAddUserAction
{
    public function __construct(
        private readonly TeamAddUserGate                 $teamAddUserGate,
        private readonly TeamRepositoryInterface         $teamRepository,
        private readonly UserRepositoryInterface         $userRepository,
        private readonly TeamUserRepository              $teamUserRepository,
        private readonly TeamUserRoleRepositoryInterface $teamUserRoleRepository,
        private readonly UserStatusChecker               $userStatusChecker,
        private readonly UserProviderInterface           $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(TeamAddUserDataInterface $data): void
    {
        $currentUser = $this->userProvider->getCurrentUser();

        $this->userStatusChecker->check($currentUser);

        $team = $this->teamRepository->getById($data->getTeamId());
        if (is_null($team)) {
            throw new ApplicationException('Team not found');
        }

        $user = $this->userRepository->getById($data->getUserId());
        if (is_null($user)) {
            throw new ApplicationException('User not found');
        }

        $role = $this->teamUserRoleRepository->getByIdAndTeam($data->getRoleId(), $team);
        if (is_null($role)) {
            throw new ApplicationException('Role not found');
        }

        $teamUser = $this->teamUserRepository->getByTeamAndUser($team, $user);
        if (!is_null($teamUser)) {
            throw new ApplicationException('The user is already a member of the team');
        }

        $this->teamAddUserGate->can($team, $currentUser);

        $teamUser                    = new TeamUser();
        $teamUser->team_id           = $team->id;
        $teamUser->user_id           = $user->id;
        $teamUser->team_user_role_id = $role->id;
        $teamUser->save();
    }
}
