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

Route::group([
    'prefix' => 'movies'
], function() {
    Route::get('/', 'MovieController@index');
    Route::get('{title}', 'MovieController@show');
    Route::post('/', 'MovieController@create');
    Route::put('{movie}', 'MovieController@update');
    Route::delete('{movie}', 'MovieController@delete');
});
