<?php

namespace App\Http\Controllers\API\v1\Project\Board\BoardColumn\Create\Dto;

use App\Jam\BoardColumn\Contract\BoardColumnCreateDataInterface;

class BoardColumnCreateData implements BoardColumnCreateDataInterface
{
    private string $title;
    private int    $boardId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
