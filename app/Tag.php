<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App
 * @property int id
 * @property string name
 * @property mixed posts
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get all posts that belong to the tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->latest();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows_tag', 'followed_id', 'following_id');
    }

    public function getType()
    {
        return "App\Tag";
    }
}
