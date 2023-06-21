<?php

namespace App\Jam\Team\Repository;

use App\Models\Team;

interface TeamRepositoryInterface
{
    /**
     * @return Team|null
     */
    public function getById(int $id): ?object;
}
