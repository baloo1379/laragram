<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @string content
 * @property Post post
 * @property User user
 */
class Comment extends Model
{
    protected $fillable = ['content', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
