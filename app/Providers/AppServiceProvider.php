<?php

namespace App\Providers;

use App\Infrastructure\Auth\UserProvider;
use App\Infrastructure\JwtToken\JwtTokenService;
use App\Jam\Auth\Service\JwtTokenServiceInterface;
use App\Jam\Auth\Service\UserProviderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(JwtTokenServiceInterface::class, JwtTokenService::class);
        $this->app->bind(UserProviderInterface::class, UserProvider::class);
    }

    public function boot(): void
    {}
}
