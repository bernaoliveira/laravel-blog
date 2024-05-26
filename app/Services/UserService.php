<?php

namespace App\Services;

use App\Http\Requests\RegistrationPostRequest;
use App\Models\User;

class UserService
{
    public function create(RegistrationPostRequest $request)
    {
        return User::create($request->safe()->only('name', 'email', 'password'));
    }
}
