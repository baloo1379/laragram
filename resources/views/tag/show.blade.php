@extends('layouts.app')

@section('content')
    <div class="row my-md-5">
        <div class="col-3 col-md-4 d-flex justify-content-center align-items-center">
            <img src="/storage/defaults/hashtag.jpg" alt="Profile image" class="d-block w-100 rounded-circle border "
                 style="max-width: 150px;">
        </div>
        <div class="col-9 col-md-8">
            <div class="text-center text-md-left">
                <h2 class="m-0 p-0">{{ $tag->name }}</h2>
                <p>
                    Posts: <span class="font-weight-bold">{{ $tag->posts->count() }}</span>
                </p>
                <a class="btn btn-primary btn-sm btn-tag" href="{{ route('follow.tag', urlencode($tag->name)) }}"
                   onclick="event.preventDefault();document.getElementById('follow-form').submit();">
                    {{ auth()->user()->followsTag($tag) ? 'Unfollow' : 'Follow' }}
                </a>
                <form id="follow-form" action="{{ route('follow.tag', urlencode($tag->name)) }}" method="post">
                    @csrf
                </form>
        </div>
        </div>
        </div>
    <hr>
    <div class="row">
        @foreach($tag->posts as $post)
            @component('layouts.post.singleGrid', ['post' => $post])
            @endcomponent
        @endforeach
    </div>

@endsection
