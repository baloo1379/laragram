<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @property int id
 * @property string description
 * @property string image
 * @property User user
 * @property \Illuminate\Database\Eloquent\Relations\BelongsToMany tags
 * @property array tagList
 * @package App
 */
class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the tags that belong to the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get array of tags attached to post
     *
     * @return array
     */
    public function tagList()
    {
        return $this->tags()->pluck('name')->toArray();
    }
}
