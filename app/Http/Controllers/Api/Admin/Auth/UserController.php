<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::authenticate($token);
        return new UserProfileResource($user);
    }

    public function update_profile(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::authenticate($token);
//        $apy = JWTAuth::getPayload($token)->toArray();
        $user->update($request->all());
        return new UserProfileResource($user);

    }
}
