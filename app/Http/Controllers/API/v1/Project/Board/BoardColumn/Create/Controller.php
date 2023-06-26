<?php

namespace App\Http\Controllers\API\v1\Project\Board\BoardColumn\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Project\Board\BoardColumn\Create\Request;
use App\Jam\BoardColumn\Action\BoardColumnCreateAction;
use App\Jam\Exception\ApplicationException;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly BoardColumnCreateAction $boardColumnCreateAction,
        private readonly JsonResponseFactory     $jsonResponseFactory
    )
    {}

    public function run(int $boardId, Request $request): JsonResponse
    {
        $data = ($request->getData())
            ->setBoardId($boardId);

        try {
            $this->boardColumnCreateAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->success($e->getMessage());
        }

        return $this->jsonResponseFactory->success('Board column created');
    }
}
