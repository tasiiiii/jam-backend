<?php

namespace App\Http\Controllers\API\v1\Project\Board\ShowOne;

use App\Jam\Board\Dto\BoardReport\BoardReport;

class OutputService
{
    public function build(BoardReport $boardReport): array
    {
        $columns = [];
        foreach ($boardReport->getColumns() as $column) {
            $columns[] = [
                'title'              => $column->getTitle(),
                'total_story_points' => $column->getTotalStoryPoints(),
            ];
        }

        return [
            'title'   => $boardReport->getTitle(),
            'columns' => $columns,
        ];
    }
}
