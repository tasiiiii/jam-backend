<?php

namespace App\Http\Controllers\API\v1\Project\Board\ShowOne;

use App\Http\Controllers\BaseController;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Service\UserStatusChecker;
use App\UI\Board\Service\BoardReportBuilder;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly BoardRepositoryInterface $boardRepository,
        private readonly BoardReportBuilder       $boardReportBuilder,
        private readonly OutputService            $outputService,
        private readonly UserStatusChecker        $userStatusChecker,
        private readonly JsonResponseFactory      $jsonResponseFactory
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(int $boardId): JsonResponse
    {
        $this->userStatusChecker->checkCurrentUser();

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
