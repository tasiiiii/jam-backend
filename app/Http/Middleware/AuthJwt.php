<?php

namespace App\Http\Middleware;

use App\Jam\Auth\Service\UserProviderInterface;
use Closure;
use http\Exception\BadHeaderException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthJwt
{
    public function __construct(
        private readonly UserProviderInterface $userProvider
    )
    {}

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->userProvider->isGuest()) {
            throw new BadHeaderException();
        }

        return $next($request);
    }
}
