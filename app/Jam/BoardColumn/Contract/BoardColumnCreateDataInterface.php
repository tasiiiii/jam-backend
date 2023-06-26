<?php

namespace App\Jam\BoardColumn\Contract;

interface BoardColumnCreateDataInterface
{
    public function getTitle(): string;
    public function getBoardId(): int;
}
