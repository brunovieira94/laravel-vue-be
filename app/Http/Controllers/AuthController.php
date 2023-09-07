<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        return $this->authService->login($request);
    }

    // public function register(Request $request){
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $token = Auth::login($user);
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User created successfully',
    //         'user' => $user,
    //         'authorization' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Successfully logged out',
    //     ]);
    // }

    // public function refresh()
    // {
    //     return response()->json([
    //         'status' => 'success',
    //         'user' => Auth::user(),
    //         'authorization' => [
    //             'token' => Auth::refresh(),
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

}
