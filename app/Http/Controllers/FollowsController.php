<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    public function user(User $user)
    {
        auth()->user()->following()->toggle($user);
        return back();
    }

    public function tag(Tag $tag)
    {
        auth()->user()->followingTags()->toggle($tag);
        return back();
    }
}
