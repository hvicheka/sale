<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'api.', 'namespace' => 'Api\Admin\Auth'], function () {
    Route::post('login', 'LoginController@login')->name('login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('profile', 'UserController@profile')->name('profile');
        Route::put('profile', 'UserController@update_profile')->name('profile.update');
    });
});

Route::group(['as' => 'api.', 'namespace' => 'Api\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    Route::get('customers', 'UsersApiController@customers');

});
