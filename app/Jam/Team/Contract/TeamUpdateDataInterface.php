<?php

namespace App\Jam\Team\Contract;

interface TeamUpdateDataInterface extends TeamIdentificationDataInterface
{
    public function getName(): string;
}
