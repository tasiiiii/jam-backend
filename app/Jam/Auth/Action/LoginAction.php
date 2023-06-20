<?php

namespace App\Jam\Auth\Action;

use App\Infrastructure\JwtToken\JwtTokenService;
use App\Jam\Auth\Contract\LoginDataInterface;
use App\Jam\Auth\Contract\TokenDataInterface;
use App\Jam\Auth\Dto\LoginPayloadData;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly JwtTokenService         $jwtTokenService
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(LoginDataInterface $data): TokenDataInterface
    {
        $user = $this->userRepository->getByEmail($data->getEmail());
        if (is_null($user)) {
            throw new ApplicationException('Wrong login or password');
        }

        if (!Hash::check($data->getPassword(), $user->password)) {
            throw new ApplicationException('Wrong login or password');
        }

        return $this->jwtTokenService->encode(
            (new LoginPayloadData())->setId($user->id)
        );
    }
}
