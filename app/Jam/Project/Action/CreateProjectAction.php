<?php

namespace App\Jam\Project\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\Project\Contract\ProjectCreateDataInterface;
use App\Jam\Project\Gate\ProjectCreateGate;
use App\Jam\Project\Enum\StatusEnum;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\Project;

class CreateProjectAction
{
    public function __construct(
        private readonly TeamRepositoryInterface $teamRepository,
        private readonly ProjectCreateGate       $projectCreateGate,
        private readonly UserStatusChecker       $userStatusChecker,
        private readonly UserProviderInterface   $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(ProjectCreateDataInterface $data): void
    {
        $currentUser = $this->userProvider->getCurrentUser();

        $this->userStatusChecker->check($currentUser);

        $team = $this->teamRepository->getById($data->getTeamId());
        if (is_null($team)) {
            throw new ApplicationException('Team not found');
        }

        $this->projectCreateGate->can($currentUser, $team);

        $project              = new Project();
        $project->title       = $data->getTitle();
        $project->description = $data->getDescription();
        $project->team_id     = $data->getTeamId();
        $project->logo        = '/uploads/projects/default.png';
        $project->status      = StatusEnum::Active;
        $project->save();
    }
}
