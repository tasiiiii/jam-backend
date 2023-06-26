<?php

namespace App\Http\Requests\API\v1\Task\Create;

use App\Http\Requests\API\v1\Task\Create\Dto\TaskCreateData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
        ];
    }

    public function getData(): TaskCreateData
    {
        return (new TaskCreateData())
            ->setTitle($this->get('title'))
            ->setDescription($this->get('description'));
    }
}
