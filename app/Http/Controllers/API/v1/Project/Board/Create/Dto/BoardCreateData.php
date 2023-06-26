<?php

namespace App\Http\Controllers\API\v1\Project\Board\Create\Dto;

use App\Jam\Board\Contract\BoardCreateDataInterface;

class BoardCreateData implements BoardCreateDataInterface
{
    private string $title;
    private int    $projectId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;

        return $this;
    }
}
