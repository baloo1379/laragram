<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        if (auth()->check()) {
            $users = auth()->user()->following->pluck('id');
            $userPosts = Post::whereIn('user_id', $users)->latest()->get();
            $tagPosts = auth()->user()->followingTags->map(function($tag){
                return $tag->posts->map(function ($post) use($tag) {
                    return $post->setTagOrigin($tag->name);
                });
            })->flatten();
            $posts = collect([$userPosts, $tagPosts])->flatten()->unique('id')->sortByDesc('created_at');
            return view('welcome', [
                'posts' => $posts,
            ]);
        } else return view('welcome');
    }
}
