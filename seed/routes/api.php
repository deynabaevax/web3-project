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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Login_RegisterController@register');

Route::apiResource('profile', 'ProfileController');

Route::resource('profile', 'ProfileController');

Route::apiResource('posts', 'PostController');

Route::get('comments', ['uses' => 'CommentController@index', 'as' => 'comments.index']);
Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentController@destroy', 'as' => 'comments.destroy']);
