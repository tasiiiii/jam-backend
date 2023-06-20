<?php

namespace App\Jam\Auth\Contract;

interface LoginDataInterface
{
    public function getEmail(): string;
    public function getPassword(): string;
}
