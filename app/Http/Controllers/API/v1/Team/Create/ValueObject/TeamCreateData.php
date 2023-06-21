<?php

namespace App\Http\Controllers\API\v1\Team\Create\ValueObject;

use App\Jam\Team\Contract\TeamCreateDataInterface;

class TeamCreateData implements TeamCreateDataInterface
{
    public function __construct(
        private readonly string $name
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }
}
