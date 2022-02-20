<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $jwt_token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }

}
