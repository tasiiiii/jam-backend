<?php

namespace App\Http\Requests\API\v1\Auth\Login;

use App\Http\Controllers\API\v1\Auth\Login\Dto\LoginData;
use App\Jam\Auth\Contract\LoginDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function getData(): LoginDataInterface
    {
        return (new LoginData())
            ->setEmail($this->get('email'))
            ->setPassword($this->get('password'));
    }
}
