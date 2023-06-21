<?php

namespace App\Http\Controllers\API\v1\Team\Update\Dto;

use App\Jam\Team\Contract\TeamUpdateDataInterface;

class TeamUpdateData implements TeamUpdateDataInterface
{
    private int    $id;
    private string $name;

    public function getTeamId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
