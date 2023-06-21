<?php

namespace App\Providers;

use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Repository\TeamRepository;
use App\Repository\TeamUserRepository;
use App\Repository\TeamUserRoleRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(TeamUserRepositoryInterface::class, TeamUserRepository::class);
        $this->app->bind(TeamUserRoleRepositoryInterface::class, TeamUserRoleRepository::class);
    }

    public function boot(): void
    {}
}
