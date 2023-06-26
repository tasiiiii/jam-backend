<?php

namespace App\Http\Requests\API\v1\Task\Create\Dto;

use App\Jam\Task\Contract\TaskCreateDataInterface;

class TaskCreateData implements TaskCreateDataInterface
{
    private string  $title;
    private ?string $description;
    private int     $boardId;

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

    public function getBoardId(): int
    {
        return $this->boardId;
    }

    public function setBoardId(int $boardId): self
    {
        $this->boardId = $boardId;

        return $this;
    }
}
