<?php

namespace App;

use App\Laragram\HasFollows;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;

/**
 * @package App
 * @property int id
 * @property string name
 * @property string email
 * @property mixed profile
 * @property mixed following
 * @property mixed followers
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasFollows;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (User $user) {
            $user->profile()->create([
                'image' => null,
                'title' => $user->name,
            ]);
        });

        static::deleting(function (User $user) {
            DB::table('follows')->where('following_id', $user->id)->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function follows(User $user)
    {
        return $this->following->contains('id', $user->id);
    }

    public function followingTags()
    {
        return $this->belongsToMany(Tag::class, 'follows_tag', 'following_id', 'followed_id');
    }

    public function followsTag(Tag $tag)
    {
        return $this->followingTags->contains('id', $tag->id);
    }

    public function getType()
    {
        return "App\User";
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
