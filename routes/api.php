<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.', 'namespace' => 'Api\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

});
