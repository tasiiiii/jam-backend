<?php

namespace App\Jam\Team\Contract;

interface TeamAddUserDataInterface extends TeamIdentificationDataInterface
{
    public function getUserId(): int;
    public function getRoleId(): int;
}
