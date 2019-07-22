<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @property int id
 * @property string title
 * @property string image
 * @property User user
 * @package App
 */
class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
