<?php

namespace App\Http\Controllers\API\v1\Ping;

use App\Http\Controllers\BaseController;
use App\UI\Response\JsonResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    private string $appVersion;

    public function __construct(
        private readonly JsonResponseFactory $jsonResponseFactory
    )
    {
        $this->appVersion = Config::get('app.version');
    }

    public function run(): JsonResponse
    {
        return $this->jsonResponseFactory->success(
            'Hello, World!',
            [
                'name'        => 'Jam',
                'description' => 'Jam - game project management system for both indie developers and studios',
                'version'     => $this->appVersion,
            ]
        );
    }
}
