<?php

namespace App\Jam\Task\Contract;

interface TaskMoveDataInterface extends TaskIdentificationInterface
{
    public function getTargetBoardColumnId(): int;
}
