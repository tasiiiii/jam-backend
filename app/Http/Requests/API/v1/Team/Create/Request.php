<?php

namespace App\Http\Requests\API\v1\Team\Create;

use App\Http\Controllers\API\v1\Team\Create\ValueObject\TeamCreateData;
use App\Jam\Team\Contract\TeamCreateDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3'
        ];
    }

    public function getData(): TeamCreateDataInterface
    {
        return new TeamCreateData($this->get('name'));
    }
}
