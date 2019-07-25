<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App
 * @property string name
 * @property \Illuminate\Database\Eloquent\Relations\BelongsToMany posts
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all posts that belong to the tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->latest();
    }

    public function getType()
    {
        return "App\Tag";
    }
}
