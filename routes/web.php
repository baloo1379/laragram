<?php

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

use App\Post;
use App\Profile;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\Input;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@home')->name('home');

Route::get('/home', 'HomeController@home')->name('default');

Route::get('/t/{tag}', 'TagController@show')->name('tag.show');

Route::get('/search', 'SearchController@search')->name('search');

Route::resource('profile', 'ProfileController', ['except' => ['index', 'create', 'store']]);

Route::resource('post', 'PostController', ['except' => ['index']]);

Route::post('/fu/{user}', 'FollowsController@user')->name('follow.user');

Route::post('/ft/{tag}', 'FollowsController@tag')->name('follow.tag');

Route::post('/c', 'CommentController@store')->name('comment.store');

Route::post('/c/{comment}', 'CommentController@update')->name('comment.update');

Route::get('/{user}', 'ProfileController@index')->name('profile.index');




