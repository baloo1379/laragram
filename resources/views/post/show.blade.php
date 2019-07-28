@extends('layouts.app')

@section('meta')
    <meta property="og:title" content="{{ $post->user->name }} on Laragram “{{ substr($post->description, 0, 64).' ...“' }}" />
    <meta property="og:image" content="{{ url($post->image) }}" />
    <meta property="og:url" content="{{ route('post.show', $post)  }}" />
    <meta property="og:description" content="{{ implode(' ', $post->tagList()) }}" />
    <meta property="og:type" content="website" />
@endsection

@section('content')
    @component('layouts.post.singleShow', ['post' => $post])
    @endcomponent
@endsection
