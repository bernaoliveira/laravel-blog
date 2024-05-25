<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthPostRequest;
use App\Http\Requests\RegistrationPostRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function login(AuthPostRequest $request)
    {
        $credentials = $request->safe()->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful'
        ]);
    }

    public function register(RegistrationPostRequest $request)
    {
        $user = $this->userService->create($request);

        if (!$user) {
            return response()->json([
                'message' => 'Registration failed'
            ], 500);
        }

        Auth::login($user);

        return response()->json([
            'message' => 'Registration successful'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }

    public function user()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }
}
