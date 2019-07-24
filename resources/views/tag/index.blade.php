@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12 col-md-8">
            <div class="d-flex align-items-center mb-2">
                <div><h2 class="m-0 p-0">{{ $tag->name }}</h2></div>
            </div>
            <div class="d-flex flex-column flex-sm-row">
                <div class="mr-5">Posts: <span class="font-weight-bold">{{ $posts->count() }}</span>
                </div>
            </div>
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-md-8">
            @foreach($posts as $post)
                @component('layouts.post.singleFeed', ['post' => $post])
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection

