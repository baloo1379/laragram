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

Route::get('/', function () {
    if (auth()->check()) {
        $users = auth()->user()->following->pluck('id');
        $posts = Post::whereIn('user_id', $users)->latest()->get();
        return view('welcome', [
            'posts' => $posts,
        ]);
    } else return view('welcome');
});

Route::get('/t/{name}', function ($name) {
    $tag = Tag::where('name', '#'.$name)->firstOrFail();
    return view('tag.show', [
        'posts' => $tag->posts,
        'tag' => $tag
    ]);
})->name('tag.show');

Route::get('/search', 'SearchController@search')->name('search');

Auth::routes();

Route::resource('profile', 'ProfileController', ['except' => ['index', 'create', 'store']]);
Route::resource('post', 'PostController', ['except' => ['index']]);

Route::get('/{username}', function ($name) {
    $user = App\User::where('name', $name)->firstOrFail();
    return view('profile.show', ['profile' => $user->profile]);
})->name('profile.index');

Route::middleware('auth')->post('/follow/{user}', function (App\User $user) {
    auth()->user()->following()->toggle($user);
    return back();
})->name('follow');


