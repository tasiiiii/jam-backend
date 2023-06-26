<?php

namespace App\Providers;

use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\Project\Repository\ProjectRepositoryInterface;
use App\Jam\Team\Repository\TeamRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRepositoryInterface;
use App\Jam\Team\Repository\TeamUserRoleRepositoryInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Repository\BoardColumnRepository;
use App\Repository\BoardRepository;
use App\Repository\ProjectRepository;
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
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(BoardColumnRepositoryInterface::class, BoardColumnRepository::class);
    }

    public function boot(): void
    {}
}
