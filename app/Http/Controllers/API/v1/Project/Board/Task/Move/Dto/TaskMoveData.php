<?php

namespace App\Http\Controllers\API\v1\Project\Board\Task\Move\Dto;

use App\Jam\Task\Contract\TaskMoveDataInterface;

class TaskMoveData implements TaskMoveDataInterface
{
    private int $taskId;
    private int $targetBoardColumnId;

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function setTaskId(int $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function getTargetBoardColumnId(): int
    {
        return $this->targetBoardColumnId;
    }

    public function setTargetBoardColumnId(int $targetBoardColumnId): self
    {
        $this->targetBoardColumnId = $targetBoardColumnId;

        return $this;
    }
}
