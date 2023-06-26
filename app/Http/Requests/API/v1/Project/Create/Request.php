<?php

namespace App\Http\Requests\API\v1\Project\Create;

use App\Http\Controllers\API\v1\Project\Create\Dto\ProjectCreateData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'required|min:3',
            'description' => 'min:3',
            'team_id'     => 'required|integer'
        ];
    }

    public function getData(): ProjectCreateData
    {
        return (new ProjectCreateData())
            ->setTitle($this->get('title'))
            ->setDescription($this->get('description'))
            ->setTeamId($this->get('team_id'));
    }
}
