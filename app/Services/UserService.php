<?php

namespace App\Services;

use App\Http\Requests\RegistrationPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(RegistrationPostRequest $request)
    {
        $password = Hash::make($request->input('password'));
        return User::create($request->safe()->merge(['password' => $password])->only(['name', 'email', 'password']));
    }
}
