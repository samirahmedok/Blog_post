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



Auth::routes();

//pages
Route::get('/', 'App\Http\Controllers\blog_postsController@index')->name('posts');
// Route::resource('/home' , 'App\Http\Controllers\HomeController');
// Route::resource('/about' , 'App\Http\Controllers\AboutController');
Route::resource('/contact' , 'App\Http\Controllers\ContactController');

//posts
Route::get('/posts/{id}' , 'App\Http\Controllers\blog_postsController@post');
Route::post('/posts', 'App\Http\Controllers\blog_postsController@store');

//comments
Route::post('/comments/{id}', 'App\Http\Controllers\CommentsController@store')->name('comments.store');

//Mail sending
Route::post('contactus' , 'App\Http\Controllers\blog_postsController@dosend')->name('contactus');

Route::get('editpost/{id}' , 'App\Http\Controllers\blog_postsController@editpost')->name('editpost');


Route::post('edit_post' , 'App\Http\Controllers\blog_postsController@update')->name('edit_post');
Route::get('delete_post/{id}' , 'App\Http\Controllers\blog_postsController@delete')->name('delete_post');

Route::get('user/verify/{token}','App\Http\Controllers\Auth\RegisterController@verifyEmail');

//tags
route::resource('tags','App\Http\Controllers\tagsController');
Route::post('tags','App\Http\Controllers\tagsController@store')->name('tags');






