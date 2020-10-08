<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@home');
Route::get('/about', 'PageController@about');
//Route::get('/posts', 'PageController@posts');

Route::get('loginOrRegister', 'Login_RegisterController@index')->name('loginOrRegister');
Route::post('register', 'Login_RegisterController@register')->name('register');
Route::get('profile','ProfileController@index')->name('profile');

Auth::routes();

Route::resource('posts', 'PostController');

Route::resource('editor', 'CKEditorController');
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/downloadPDF/{id}', 'PostController@downloadPDF');

Route::resource('profile', 'ProfileController');

Route::get('comments', ['uses' => 'CommentController@index', 'as' => 'comments.index']);
Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentController@destroy', 'as' => 'comments.destroy']);
// Route::resource('comment', 'CommentController');

Route::get('/search', 'PostController@search');
//Route::resource('posts','PostsController');
