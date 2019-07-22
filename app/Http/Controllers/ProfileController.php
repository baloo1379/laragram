<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return redirect(route('profile.index', $profile->user->name));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $attr = $request->validate([
            'title' => '',
            'website' => '',
            'biogram' => '',
            'image' => 'image',
        ]);

        if ($request->has('image')) {
            $imagePath = '/storage/' . $request->image->store('profile', 'public');
            $image = Image::make(public_path($imagePath))->fit(env('AVATAR_SIZE', 300));
            unlink(substr($imagePath, 1));
            $jpg = Image::canvas(env('AVATAR_SIZE', 300), env('AVATAR_SIZE', 300), '#ffffff');
            $jpg->insert($image);
            $imagePath = 'storage/profile/' . $image->filename . '.jpg';
            $jpg->save($imagePath);
            $attr['image'] = '/' . $imagePath;
        }

        $profile->update($attr);

        return redirect(route('profile.show', $profile));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('update', $profile);
    }
}
