<?php

namespace App\Infrastructure\Auth;

use App\Jam\Auth\Service\JwtTokenServiceInterface;
use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\User;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface  $userRepository,
        private readonly JwtTokenServiceInterface $jwtTokenService
    )
    {}

    public function getCurrentUser(): User
    {
        $token = request()->header('Authorization');
        $id    = $this->jwtTokenService->decode($token);

        return $this->userRepository->getById($id);
    }
}
