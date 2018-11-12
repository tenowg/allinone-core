<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::prefix('/menu')->group(function() {
    Route::get('/main', 'MenuController@generateMenu');
});

Route::prefix('user')->middleware('jwt.auth')->group(function() {
    Route::get('current', 'UserController@getCurrentUser');
});

Route::prefix('permissions')->middleware('jwt.auth')->group(function() {
    Route::get('list-permissions', 'PermissionsController@listAllPermissions');
    Route::post('create', 'PermissionsController@createPermissionGroup');
    Route::get('groups', 'PermissionsController@listAllGroups');
    Route::post('save', 'PermissionsController@savePermissionGroup');
});

Route::prefix('corp')->middleware('jwt.auth')->group(function() {
    Route::get('public/{corp}', 'CorporationController@getCorporationPublic')->middleware('can:view,corp', 'check.auth');
    Route::get('corps', 'CorporationController@getCorporations');
});

Route::prefix('alliance')->middleware('jwt.auth')->group(function() {
    Route::get('public/{alliance}', 'AllianceController@getAlliancePublic');
    Route::get('alliances', 'AllianceController@getAlliances');
});

Route::prefix('character')->group(function() {
    Route::get('public/{character}', 'CharacterController@getCharacterPublic')->middleware('check.auth');
    Route::get('stats/{character}', 'CharacterStatsController@getStats')->middleware('can:viewStats,character', 'check.auth');
    Route::get('profile/{character}', 'CharacterController@getCharacterProfile')->middleware('can:viewProfile,character', 'check.auth');
});
