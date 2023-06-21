<?php

namespace App\Http\Controllers\API\v1\Team\Update;

use App\Http\Requests\API\v1\Team\Update\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Action\TeamUpdateAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller
{
    public function __construct(
        private readonly TeamUpdateAction    $teamUpdateAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(int $id, Request $request): JsonResponse
    {
        $data = $request->getData();
        $data->setId($id);

        try {
            $team = $this->teamUpdateAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success(
            'Team updated',
            [
                'id' => $team->id
            ]
        );
    }
}
