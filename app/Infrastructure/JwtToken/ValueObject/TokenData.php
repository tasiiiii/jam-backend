<?php

namespace App\Infrastructure\JwtToken\ValueObject;

use App\Jam\Auth\Contract\TokenDataInterface;

class TokenData implements TokenDataInterface
{
    public function __construct(
        private readonly string $token,
        private readonly int    $expiredAt
    )
    {}

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiredAt(): int
    {
        return $this->expiredAt;
    }
}
