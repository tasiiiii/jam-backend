<?php

namespace App\Jam\Auth\Service;

use App\Jam\Auth\Contract\LoginPayloadDataInterface;
use App\Jam\Auth\Contract\TokenDataInterface;

interface JwtTokenServiceInterface
{
    public function encode(LoginPayloadDataInterface $data): TokenDataInterface;
    public function decode(string $token): int;
}
