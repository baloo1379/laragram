<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        // $tag = Tag::where('name', '#'.$name)->firstOrFail();
        return view('tag.show', compact('tag'));
    }
}
