<?php

namespace App\Http\Requests\API\v1\Team\Update;

use App\Http\Controllers\API\v1\Team\Update\Dto\TeamUpdateData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3'
        ];
    }

    public function getData(): TeamUpdateData
    {
        return (new TeamUpdateData())
            ->setName($this->get('name'));
    }
}
