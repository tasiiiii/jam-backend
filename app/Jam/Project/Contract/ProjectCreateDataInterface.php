<?php

namespace App\Jam\Project\Contract;

interface ProjectCreateDataInterface
{
    public function getTitle(): string;
    public function getDescription(): ?string;
    public function getTeamId(): int;
}
