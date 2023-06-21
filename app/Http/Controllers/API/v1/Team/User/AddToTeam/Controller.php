<?php

namespace App\Http\Controllers\API\v1\Team\User\AddToTeam;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Team\User\AddToTeam\Request;
use App\Jam\Exception\ApplicationException;
use App\Jam\Team\Action\TeamAddUserAction;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly TeamAddUserAction   $teamAddUserAction,
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {}

    public function run(int $teamId, int $userId, Request $request): JsonResponse
    {
        $data = ($request->getData())
            ->setTeamId($teamId)
            ->setUserId($userId);

        try {
            $this->teamAddUserAction->run($data);
        } catch (ApplicationException $e) {
            return $this->jsonResponseFactory->error($e->getMessage());
        }

        return $this->jsonResponseFactory->success('User added to team');
    }
}
