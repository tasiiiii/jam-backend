<?php

namespace App\Http\Controllers\API\v1\Project\Board\ShowOne;

use App\UI\Board\Dto\BoardReport\BoardReport;

class OutputService
{
    public function build(BoardReport $boardReport): array
    {
        $columns = [];
        foreach ($boardReport->getColumns() as $column) {
            $tasks       = $column->getTasks();
            $outputTasks = [];
            foreach ($tasks as $task) {
                $outputTasks[] = [
                    'id'          => $task->getId(),
                    'title'       => $task->getTitle(),
                    'code'        => $task->getCode(),
                    'story_point' => $task->getStoryPoint(),
                    'creator'     => $task->getCreator(),
                    'executor'    => $task->getExecutor(),
                ];
            }

            $columns[] = [
                'id'                 => $column->getId(),
                'title'              => $column->getTitle(),
                'total_story_points' => $column->getTotalStoryPoints(),
                'tasks'              => $outputTasks,
            ];
        }

        return [
            'title'   => $boardReport->getTitle(),
            'columns' => $columns,
        ];
    }
}
