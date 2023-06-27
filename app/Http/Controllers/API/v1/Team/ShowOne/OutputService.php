<?php

namespace App\Http\Controllers\API\v1\Team\ShowOne;

use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\Project;
use App\Models\Team;
use App\UI\User\UserService;

class OutputService
{
    public function __construct(
        private readonly UserRepositoryInterface    $userRepository,
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly UserService                $userService
    )
    {}

    public function build(Team $team): array
    {
        $user = $this->userRepository->getById($team->creator_id);

        $projects   = $this->projectRepository->getByTeam($team);
        $projectOutputData = [];
        /** @var Project $project */
        foreach ($projects as $project) {
            $projectOutputData[] = [
                'id'    => $project->id,
                'title' => $project->title,
                'logo'  => $project->logo,
            ];
        }

        return [
            'id'       => $team->id,
            'name'     => $team->name,
            'logo'     => $team->logo,
            'creator'  => $this->userService->buildFullName($user),
            'projects' => $projectOutputData,
        ];
    }
}
