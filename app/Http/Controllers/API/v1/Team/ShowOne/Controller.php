<?php

namespace App\Http\Controllers\API\v1\Team\ShowOne;

use App\Http\Controllers\BaseController;
use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    public function __construct(
        private readonly TeamRepositoryInterface $teamRepository,
        private readonly UserProviderInterface   $userProvider,
        private readonly OutputService           $outputService,
        private readonly JsonResponseFactory     $jsonResponseFactory
    )
    {}

    public function run(int $id): JsonResponse
    {
        $user = $this->userProvider->getCurrentUser();

        $team = $this->teamRepository->getByIdAndUser($id, $user);
        if (is_null($team)) {
            return $this->jsonResponseFactory->error(
                message: 'Team not found',
                code: Response::HTTP_NOT_FOUND
            );
        }

        return $this->jsonResponseFactory->success(
            'Team',
            $this->outputService->build($team),
        );
    }
}
