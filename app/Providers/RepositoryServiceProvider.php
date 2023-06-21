<?php

namespace App\Providers;

use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
    }

    public function boot(): void
    {}
}
