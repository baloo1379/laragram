<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * @property int id
 * @property string title
 * @property string website
 * @property string biogram
 * @property string image
 * @property User user
 * @mixin \Eloquent
 */
class Profile extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getType()
    {
        return "App\Profile";
    }

    public function getImage()
    {
        if(is_null($this->image)) {
            return asset('storage/defaults/user.jpg');
        }
        else return asset($this->image);
    }

    public function setImage(Request $request)
    {
        if($request->has('removeImage') && $request->get('removeImage') == 1) {
            $this->image = null;
            $this->save();
        }
        if ($request->has('image')) {
            $imagePath = '/storage/' . $request->image->store('profile', 'public');
            $image = Image::make(public_path($imagePath))->fit(env('AVATAR_SIZE', 300));
            unlink(substr($imagePath, 1));
            $jpg = Image::canvas(env('AVATAR_SIZE', 300), env('AVATAR_SIZE', 300), '#ffffff');
            $jpg->insert($image);
            $imagePath = 'storage/profile/' . $image->filename . '.jpg';
            $jpg->save($imagePath);
            $this->image = '/'.$imagePath;
            $this->save();
        }
    }
}
