<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::post('/login', [UserController::class, 'login']);


Route::post('login', 'User\UserController@login');
Route::group(['namespace' => 'User', 'middleware' => ['auth:sanctum']], function () {
    Route::get('users', 'UserController@getAllUsers')->name('user.index');
    Route::post('register', 'UserController@register');
    Route::get('user/{id}/show', 'UserController@show')->name('user.show');
    Route::post('user/{id}/update', 'UserController@update')->name('user.update');
    Route::post('user/{id}/destroy', 'UserController@destroy')->name('user.destroy');
    Route::get('/user/{id}/permissions', 'UserController@getUserPermissions');
    Route::get('/user/{id}/roles', 'UserController@getUserRole');
    Route::get('/logout', 'UserController@logout');
});


Route::group(['namespace' => 'Role', 'middleware' => ['auth:sanctum']], function () {

    Route::get('roles', 'RoleController@index')->name('role.index');
    Route::post('role/create', 'RoleController@create')->name('role.create');
    Route::post('assign-role-to-user/{role_id}/{user_id}', 'RoleController@assignRoleToUser');
    Route::post('remove-role-from-user/{role_id}/{user_id}', 'RoleController@removeRoleFromUser');
    Route::get('role/{id}permissions', 'RoleController@showRolePermissions')->name('role.show');
    Route::post('role/{id}/update', 'RoleController@update')->name('role.update');
    Route::get('role/{id}/users', 'RoleController@getRoleUsers');
    Route::post('role/{id}/destroy', 'RoleController@destroy')->name('role.destroy');
    Route::post('roles-test-delete', 'RoleController@softdelete');
    Route::post('roles-test-restore', 'RoleController@restore');
    Route::post('roles-test-forceDelete', 'RoleController@forceDelete');

});


Route::group(['namespace' => 'Permission', 'middleware' => ['auth:sanctum']], function () {

    Route::get('permission/{id}/users', 'PermissionController@getPermissionUsers');
    Route::get('permission/{id}/roles', 'PermissionController@getPermissionRoles');
    Route::post('assign-permissions-to-user/{user_id}/{permission_id}', 'PermissionController@assignPermissionsToUser');
    Route::post('revoke-permission-from-user/{user_id}/{permission_id}', 'PermissionController@revokePermissionFromUser');
    Route::get('user/{id}/permissions/name', 'PermissionController@getUserPermissionsNames');

});




