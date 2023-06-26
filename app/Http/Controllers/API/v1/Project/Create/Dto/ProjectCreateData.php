<?php

namespace App\Http\Controllers\API\v1\Project\Create\Dto;

use App\Jam\Project\Contract\ProjectCreateDataInterface;

class ProjectCreateData implements ProjectCreateDataInterface
{
    private string  $title;
    private ?string $description = null;
    private int     $teamId;


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function setTeamId(int $teamId): self
    {
        $this->teamId = $teamId;

        return $this;
    }
}
