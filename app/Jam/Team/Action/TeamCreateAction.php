<?php

namespace App\Jam\Team\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Contract\TeamCreateDataInterface;
use App\Jam\Team\Enum\StatusEnum;
use App\Jam\Team\Gate\TeamCreateGate;
use App\Models\Team;

class TeamCreateAction
{
    public function __construct(
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
        $this->teamCreateGate->can($currentUser);

        $team             = new Team();
        $team->name       = $data->getName();
        $team->logo       = '/uploads/teams/logos/default.png';
        $team->creator_id = $currentUser->id;
        $team->status     = StatusEnum::Active;

        $team->save();

        return $team;
    }
}
