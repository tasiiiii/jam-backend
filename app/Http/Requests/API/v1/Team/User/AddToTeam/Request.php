<?php

namespace App\Http\Requests\API\v1\Team\User\AddToTeam;

use App\Http\Controllers\API\v1\Team\User\AddToTeam\Dto\TeamAddUserData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'role_id' => 'required|integer'
        ];
    }

    public function getData(): TeamAddUserData
    {
        return (new TeamAddUserData())
            ->setRoleId($this->get('role_id'));
    }
}
