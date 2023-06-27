<?php

namespace App\Http\Requests\API\v1\Project\Board\Task\Move;

use App\Http\Controllers\API\v1\Project\Board\Task\Move\Dto\TaskMoveData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'target_board_column_id' => 'required|integer'
        ];
    }

    public function getData(): TaskMoveData
    {
        return (new TaskMoveData())
            ->setTargetBoardColumnId($this->get('target_board_column_id'));
    }
}
