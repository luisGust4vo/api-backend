<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');
        return response()->json($this->authService->register($data));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return response()->json($this->authService->login($credentials));
    }

    public function logout()
    {
        return response()->json($this->authService->logout());
    }

    public function me()
    {
        return response()->json($this->authService->me());
    }
}
