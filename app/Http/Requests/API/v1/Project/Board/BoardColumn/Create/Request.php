<?php

namespace App\Http\Requests\API\v1\Project\Board\BoardColumn\Create;

use App\Http\Controllers\API\v1\Project\Board\BoardColumn\Create\Dto\BoardColumnCreateData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:3'
        ];
    }

    public function getData(): BoardColumnCreateData
    {
        return (new BoardColumnCreateData())
            ->setTitle($this->get('title'));
    }
}
