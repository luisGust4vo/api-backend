<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return ['user' => $user, 'token' => $token];
    }

    public function login($credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return ['error' => 'Unauthorized', 'status' => 401];
        }

        return ['token' => $token];
    }

    public function logout()
    {
        Auth::logout();
        return ['message' => 'Successfully logged out'];
    }

    public function me()
    {
        return Auth::user();
    }
}
