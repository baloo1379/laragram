<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param \App\User $user
     * @param \App\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id == $post->user->id;
    }
}
