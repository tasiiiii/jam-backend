<?php

namespace App\Http\Controllers\API\v1\Project\Board\Task\Backlog;

use App\Models\Task;

class OutputService
{
    public function build(Task $task): array
    {
        return [
            'id'    => $task->id,
            'title' => $task->title,
        ];
    }
}
