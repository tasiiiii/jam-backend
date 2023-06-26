<?php

namespace App\Http\Controllers\API\v1\Project\Board\Show;

use App\Http\Controllers\BaseController;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly BoardRepositoryInterface   $boardRepository,
        private readonly OutputService              $outputService,
        private readonly JsonResponseFactory        $jsonResponseFactory
    )
    {}

    public function run(int $projectId): JsonResponse
    {
        $project = $this->projectRepository->getById($projectId);
        if (is_null($project)) {
            return $this->jsonResponseFactory->error(message: 'Project not found', code: Response::HTTP_NOT_FOUND);
        }

        $boards     = $this->boardRepository->getByProject($project);
        $outputData = [];
        foreach ($boards as $board) {
            $outputData[] = $this->outputService->build($board);
        }

        return $this->jsonResponseFactory->success(
            'Boards',
            [
                'boards' => $outputData,
            ]
        );
    }
}
