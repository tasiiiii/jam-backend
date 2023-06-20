<?php

namespace App\Http\Controllers\API\v1\Auth\Me;

use App\Http\Controllers\BaseController;
use App\Jam\Auth\Service\UserProviderInterface;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function __construct(
        private readonly UserProviderInterface $userProvider,
        private readonly OutputService         $outputService,
        private readonly JsonResponseFactory   $jsonResponseFactory
    )
    {}

    public function run(): JsonResponse
    {
        return $this->jsonResponseFactory->success(
            'Current user',
            $this->outputService->build(
                $this->userProvider->getCurrentUser()
            )
        );
    }
}
