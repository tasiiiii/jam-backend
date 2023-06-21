<?php

namespace App\Http\Controllers\API\v1\Team\Create;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Team\Create\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Action\TeamCreateAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly TeamCreateAction    $teamCreateAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(Request $request): JsonResponse
    {
        try {
            $team = $this->teamCreateAction->run($request->getData());
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success(
            'Team created',
            [
                'id' => $team->id,
            ]
        );
    }
}
