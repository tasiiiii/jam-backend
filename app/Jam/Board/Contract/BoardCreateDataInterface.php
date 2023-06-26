<?php

namespace App\Jam\Board\Contract;

interface BoardCreateDataInterface
{
    public function getTitle(): string;
    public function getProjectId(): int;
}
