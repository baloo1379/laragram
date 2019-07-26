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
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $guarded = [];

    private $fromTag = false;

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

    public function getType()
    {
        return "App\Post";
    }

    public function setTagOrigin(string $value)
    {
        $this->fromTag = $value;
        return $this;
    }

    public function getTagOrigin()
    {
        return $this->fromTag;
    }
}
