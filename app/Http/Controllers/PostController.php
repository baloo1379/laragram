<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    private $reTag = '/\#\w+/m';

    /**
     * PostController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['verified', 'auth'])->except('show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'image' => ['image', 'required'],
            'description' => ''
        ]);

        $imagePath = '/storage/' . $request->image->store('posts', 'public');
        $image = Image::make(public_path($imagePath))->fit(env('PHOTO_SIZE', 1000));
        unlink(substr($imagePath, 1));
        $jpg = Image::canvas(env('PHOTO_SIZE', 1000), env('PHOTO_SIZE', 1000), '#ffffff');
        $jpg->insert($image);
        $imagePath = 'storage/posts/' . $image->filename . '.jpg';
        $jpg->save($imagePath);
        $attr['image'] = '/' . $imagePath;

        $post = auth()->user()->posts()->create($attr);

        preg_match_all($this->reTag, $post->description, $matches, PREG_SET_ORDER, 0);

        if($matches && !empty($matches)) {
            $tagList = array_map(function ($match) {
                return Tag::firstOrCreate(['name' => $match[0]])->id;
            }, $matches);

            $post->tags()->attach($tagList);
        }

        return redirect(route('post.show', $post));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        dd($request->all(), $post);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        return redirect('/');
    }
}
