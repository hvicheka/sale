<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return new UserProfileResource(auth()->user());
    }

    public function update_profile(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $user->update($request->all());
        return new UserProfileResource($user);
    }
}
