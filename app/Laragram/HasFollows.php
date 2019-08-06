<?php


namespace App\Laragram;


use App\User;

trait HasFollows
{
    public function followers()
    {
        $table = 'follows';
        if ($this->getType('App\Tag')); { $table = 'follows_tag'; }
        return $this->belongsToMany(User::class, $table, 'followed_id', 'following_id');
    }
}