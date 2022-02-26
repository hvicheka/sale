<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\User;

class UserController extends Controller
{
    public function profile()
    {
        return new UserProfileResource(auth()->user());
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $user = User::findOrFail(auth()->id());
        $user->update($request->validated());
        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }
        return new UserProfileResource($user);
    }
}
