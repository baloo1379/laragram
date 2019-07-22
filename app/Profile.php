<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string website
 * @property string biogram
 * @property User user
 */
class Profile extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
