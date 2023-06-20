<?php

namespace App\Http\Requests\API\v1\User\Create;

use App\Http\Controllers\API\v1\User\Create\Dto\UserCreateData;
use App\Jam\User\Contract\UserCreateDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'  => 'required|regex:/^[a-zA-Z]+$/u',
            'middle_name' => 'regex:/^[a-zA-Z]+$/u',
            'last_name'   => 'required|regex:/^[a-zA-Z]+$/u',
            'email'       => 'required|email',
            'password'    => 'required|min:8|confirmed'
        ];
    }

    public function getData(): UserCreateDataInterface
    {
        return (new UserCreateData())
            ->setFirstName($this->get('first_name'))
            ->setMiddleName($this->get('middle_name'))
            ->setLastName($this->get('last_name'))
            ->setEmail($this->get('email'))
            ->setPassword($this->get('password'));
    }
}
