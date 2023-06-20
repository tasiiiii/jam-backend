<?php

namespace App\Jam\Auth\Dto;

use App\Jam\Auth\Contract\LoginPayloadDataInterface;

class LoginPayloadData implements LoginPayloadDataInterface
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
