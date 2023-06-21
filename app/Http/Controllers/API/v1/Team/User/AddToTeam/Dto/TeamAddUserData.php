<?php

namespace App\Http\Controllers\API\v1\Team\User\AddToTeam\Dto;

use App\Jam\Team\Contract\TeamAddUserDataInterface;

class TeamAddUserData implements TeamAddUserDataInterface
{
    private int $teamId;
    private int $userId;
    private int $roleId;

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function setTeamId(int $teamId): self
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): self
    {
        $this->roleId = $roleId;

        return $this;
    }
}
