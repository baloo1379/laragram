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

Route::get('/', function () {
    if (auth()->check()) {
        $users = auth()->user()->following->pluck('id');
        $posts = \App\Post::whereIn('user_id', $users)->latest()->get();
        return view('welcome', [
            'posts' => $posts,
        ]);
    } else return view('welcome');
});

Route::get('/search', function () {
    $q = \Illuminate\Support\Facades\Input::get('q', '');
    if ($q[0] == '@') {
        // searching user with that name
        $name = substr($q, 1);
        $users = \App\User::where('name', 'like', '%' . $name . '%')->get()->pluck('id')->toArray();
        $profiles = \App\Profile::where('title', 'like', '%' . $name . '%')->get()->pluck('user_id')->toArray();
        $id = array_unique(array_merge($users, $profiles), SORT_REGULAR);
    } else {
        $users = \App\User::where('name', 'like', '%' . $q . '%')->get()->pluck('id')->toArray();
        $profiles = \App\Profile::where('title', 'like', '%' . $q . '%')->get()->pluck('user_id')->toArray();
        $id = array_unique(array_merge($users, $profiles), SORT_REGULAR);
    }

    $usersResult = \App\User::whereIn('id', $id)->get();

    return view('search', [
        'users' => $usersResult
    ]);
})->name('search');

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


