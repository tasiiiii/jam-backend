<?php

namespace App\Jam\Auth\Contract;

interface TokenDataInterface
{
    public function getToken(): string;
    public function getExpiredAt(): int;
}
