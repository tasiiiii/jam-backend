<?php

namespace App\Jam\Team\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Permission\Enum\PermissionEnum;
use App\Jam\Team\Contract\TeamCreateDataInterface;
use App\Jam\Team\Enum\StatusEnum;
use App\Jam\Team\Gate\TeamCreateGate;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\TeamUserRole;

class TeamCreateAction
{
    public function __construct(
        private readonly UserStatusChecker     $userStatusChecker,
        private readonly UserProviderInterface $userProvider,
        private readonly TeamCreateGate        $teamCreateGate
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(TeamCreateDataInterface $data): Team
    {
        $currentUser = $this->userProvider->getCurrentUser();

        $this->userStatusChecker->check($currentUser);
        $this->teamCreateGate->can($currentUser);

        $team             = new Team();
        $team->name       = $data->getName();
        $team->logo       = '/uploads/teams/logos/default.png';
        $team->creator_id = $currentUser->id;
        $team->status     = StatusEnum::Active;
        $team->save();

        $teamUserRole             = new TeamUserRole();
        $teamUserRole->team_id    = $team->id;
        $teamUserRole->name       = 'Boss';
        $teamUserRole->permission = PermissionEnum::GOD_MODE->value;
        $teamUserRole->save();

        $teamUser                    = new TeamUser();
        $teamUser->team_id           = $team->id;
        $teamUser->user_id           = $currentUser->id;
        $teamUser->team_user_role_id = $teamUserRole->id;
        $teamUser->save();

        return $team;
    }
}
