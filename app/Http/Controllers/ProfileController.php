<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth'])->except(['index', 'show']);
    }

    public function index(User $user)
    {
        return view('profile.show', ['profile' => $user->profile]);
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
        $profile->update($this->validation($request));
        $profile->setImage($request);

        return redirect(route('profile.show', $profile));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('update', $profile);
        $user = $profile->user;

        $user->delete();
        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyPosts(Profile $profile)
    {
        $this->authorize('update', $profile);

        $posts = $profile->user->posts()->getResults();

        foreach ($posts as $post) {
            $imagePath = public_path(substr($post->image, 1));
            File::delete($imagePath);
            $post->delete();
        }

        return redirect(route('profile.show', $profile->id));
    }

    private function validation(Request $request)
    {
         return $request->validate([
            'title' => 'required|not_regex:/\#\w+/m',
            'website' => 'nullable|url',
            'biogram' => 'nullable|string',
        ]);
    }
}
