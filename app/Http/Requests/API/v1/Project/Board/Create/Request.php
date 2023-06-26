<?php

namespace App\Http\Requests\API\v1\Project\Board\Create;

use App\Http\Controllers\API\v1\Project\Board\Create\Dto\BoardCreateData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
        ];
    }

    public function getData(): BoardCreateData
    {
        return (new BoardCreateData())
            ->setTitle($this->get('title'));
    }
}
