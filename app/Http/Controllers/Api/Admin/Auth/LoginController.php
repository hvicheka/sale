<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        if (preg_match('/(0|\+?\d{2})(\d{7,8})/', $email, $matches)) {
            $credentials = ['phone' => $email, 'password' => $request->get('password')];
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $email, 'password' => $request->get('password')];
        } else {
            $credentials = ['username' => $email, 'password' => $request->get('password')];
        }
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credentials not match'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ], Response::HTTP_OK);
    }

}
