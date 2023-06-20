<?php

namespace App\Jam\User\Action;

use App\Jam\Exception\ApplicationException;
use App\Jam\User\Contract\UserCreateDataInterface;
use App\Jam\User\Enum\StatusEnum;
use App\Jam\User\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreateAction
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(UserCreateDataInterface $data): void
    {
        $user = $this->userRepository->getByEmail($data->getEmail());
        if (!is_null($user)) {
            throw new ApplicationException(
                sprintf('User with email - "%s" already exists', $data->getEmail())
            );
        }

        $user              = new User();
        $user->first_name  = $data->getFirstName();
        $user->middle_name = $data->getMiddleName();
        $user->last_name   = $data->getLastName();
        $user->email       = $data->getEmail();
        $user->avatar      = '/uploads/users/avatars/default.png';
        $user->status      = StatusEnum::Active->value;
        $user->password    = Hash::make($data->getPassword());

        $user->save();
    }
}
