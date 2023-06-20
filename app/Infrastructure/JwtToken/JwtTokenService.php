<?php

namespace App\Infrastructure\JwtToken;

use App\Infrastructure\JwtToken\ValueObject\TokenData;
use App\Jam\Auth\Contract\LoginPayloadDataInterface;
use App\Jam\Auth\Contract\TokenDataInterface;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Config;

class JwtTokenService
{
    private string $domain;
    private string $secret;
    private int    $ttl;

    public function __construct()
    {
        $this->domain = Config::get('app.url');
        $this->secret = Config::get('jwt.secret');
        $this->ttl    = Config::get('jwt.ttl');
    }

    public function encode(LoginPayloadDataInterface $data): TokenDataInterface
    {
        $iat = new DateTime();
        $nbf = (clone $iat)->modify(sprintf('+%d seconds', $this->ttl));

        $payload = [
            'iss' => $this->domain,
            'aud' => $this->domain,
            'iat' => $iat->getTimestamp(),
            'nbf' => $nbf->getTimestamp(),
            'id'  => $data->getId(),
        ];

        $token = JWT::encode($payload, $this->secret, 'HS256');

        return new TokenData(
            JWT::encode($payload, $this->secret, 'HS256'),
            $nbf->getTimestamp()
        );
    }

    public function decode(string $token): int
    {
        $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));

        return $decoded['id'];
    }
}
