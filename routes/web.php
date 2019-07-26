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

Route::get('/', function () {
    if (auth()->check()) {
        $users = auth()->user()->following->pluck('id');
        $userPosts = Post::whereIn('user_id', $users)->latest()->get();
        $tagPosts = auth()->user()->followingTags->map(function($tag){
            return $tag->posts->map(function ($post) use($tag) {
                return $post->setTagOrigin($tag->name);
            });
        })->flatten();
        $posts = collect([$userPosts, $tagPosts])->flatten()->unique('id');
        return view('welcome', [
            'posts' => $posts,
        ]);
    } else return view('welcome');
})->name('home');

Route::get('/t/{tag}', 'TagController@show')->name('tag.show');

Route::get('/search', 'SearchController@search')->name('search');

Route::resource('profile', 'ProfileController', ['except' => ['index', 'create', 'store']]);

Route::resource('post', 'PostController', ['except' => ['index']]);

Route::post('/fu/{user}', 'FollowsController@user')->name('follow.user');

Route::post('/ft/{tag}', 'FollowsController@tag')->name('follow.tag');

Route::get('/{user}', 'ProfileController@index')->name('profile.index');




