<?php

namespace App\Http\Controllers\API\v1\Project\Board\ShowOne;

use App\Http\Controllers\BaseController;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Board\Service\BoardReportBuilder;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly BoardRepositoryInterface $boardRepository,
        private readonly BoardReportBuilder       $boardReportBuilder,
        private readonly OutputService            $outputService,
        private readonly JsonResponseFactory      $jsonResponseFactory
    )
    {}

    public function run(int $boardId): JsonResponse
    {
        $board = $this->boardRepository->getById($boardId);
        if (is_null($board)) {
            return $this->jsonResponseFactory->error('Board not found');
        }

        return $this->jsonResponseFactory->success(
            'Board',
            [
                'report' => $this->outputService->build(
                    $this->boardReportBuilder->build($board)
                ),
            ]
        );
    }
}
