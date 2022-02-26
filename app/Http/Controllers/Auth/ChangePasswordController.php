<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Traits\ImageUploadTrait;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    use ImageUploadTrait;

    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        if ($request->password) {
            auth()->user()->update(['password' => bcrypt($request->password)]);
        }

        if ($request->file('profile_image')) {
            auth()->user()->update(['profile_image' => $this->updateImage(auth()->user()->profile_image, $request->file('profile_image'))]);
        }

        return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    }
}
