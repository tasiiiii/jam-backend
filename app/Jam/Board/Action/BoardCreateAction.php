<?php

namespace App\Jam\Board\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Board\Contract\BoardCreateDataInterface;
use App\Jam\Board\Gate\BoardCreateGate;
use App\Jam\Exception\ApplicationException;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\Board;

class BoardCreateAction
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly BoardCreateGate            $boardCreateGate,
        private readonly UserStatusChecker          $userStatusChecker,
        private readonly UserProviderInterface      $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(BoardCreateDataInterface $data): void
    {
        $currentUser = $this->userProvider->getCurrentUser();
        $this->userStatusChecker->check($currentUser);

        $project = $this->projectRepository->getById($data->getProjectId());
        if (is_null($project)) {
            throw new ApplicationException('Project not found');
        }

        $this->boardCreateGate->can($currentUser, $project);

        $board             = new Board();
        $board->title      = $data->getTitle();
        $board->project_id = $project->id;
        $board->save();
    }
}
