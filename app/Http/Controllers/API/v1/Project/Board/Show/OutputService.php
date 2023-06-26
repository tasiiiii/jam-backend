<?php

namespace App\Http\Controllers\API\v1\Project\Board\Show;

use App\Models\Board;

class OutputService
{
    public function build(Board $board): array
    {
        return [
            'id'    => $board->id,
            'title' => $board->title,
        ];
    }
}
