<?php

namespace App\Services;

use App\Http\Requests\RegistrationPostRequest;
use App\Models\User;

class UserService
{
    public function create(RegistrationPostRequest $request)
    {
        $credentials = $request->safe()->only('name', 'email', 'password');

        $user = new User;
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = bcrypt($credentials['password']);

        $user->save();

        return response()->json([
            'message' => 'User created successfully'
        ]);
    }
}
