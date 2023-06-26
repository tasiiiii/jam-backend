<?php

namespace App\Jam\Team\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Contract\TeamUpdateDataInterface;
use App\Jam\Team\Gate\TeamUpdateGate;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\Team;

class TeamUpdateAction
{
    public function __construct(
        private readonly TeamRepositoryInterface $teamRepository,
        private readonly TeamUpdateGate          $teamUpdateGate,
        private readonly UserStatusChecker       $userStatusChecker,
        private readonly UserProviderInterface   $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(TeamUpdateDataInterface $data): Team
    {
        $user = $this->userProvider->getCurrentUser();

        $this->userStatusChecker->check($user);

        $team = $this->teamRepository->getById($data->getTeamId());
        if (is_null($team)) {
            throw new ApplicationException('Team not found');
        }

        $this->teamUpdateGate->can($user, $team);

        $team->name = $data->getName();
        $team->save();

        return $team;
    }
}
