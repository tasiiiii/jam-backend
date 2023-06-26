<?php

namespace App\Jam\Task\Contract;

interface TaskCreateDataInterface
{
    public function getTitle(): string;
    public function getDescription(): ?string;
    public function getBoardId(): int;
}
