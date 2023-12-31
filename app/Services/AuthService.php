<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($requestInfo)
    {
        $credentials = $requestInfo->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout()
    {
        Auth::logout();
        return [
            'success' => true,
        ];
    }
}
