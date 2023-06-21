<?php

namespace App\Http\Controllers\API\v1\Team\Show;

use App\Http\Controllers\BaseController;
use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly TeamRepositoryInterface $teamRepository,
        private readonly UserProviderInterface   $userProvider,
        private readonly OutputService           $outputService,
        private readonly JsonResponseFactory     $jsonResponseFactory
    )
    {}

    public function run(): JsonResponse
    {
        $user  = $this->userProvider->getCurrentUser();
        $teams = $this->teamRepository->getByUser($user);

        $data = [];
        foreach ($teams as $team) {
            $data[] = $this->outputService->build($team);
        }

        return $this->jsonResponseFactory->success(
            'Teams',
            $data
        );
    }
}
