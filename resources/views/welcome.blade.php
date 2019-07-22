@extends('layouts.app')

@section('content')
    @auth
        <div class="row">
            <div class="col-12 col-md-8">
                @if( $posts->isEmpty() )
                    <div class="col-12 d-flex justify-content-center">
                        <div class="text-muted">
                            Lets find new friends and follow them
                        </div>
                    </div>
                @endif
                @foreach($posts as $post)
                    @component('layouts.post.singleFeed', ['post' => $post])
                    @endcomponent
                @endforeach
            </div>
            <div class="col-12 col-md-4 pt-md-3 d-none d-md-block">
                @component('layouts.user', ['profile' => auth()->user()->profile])
                @endcomponent
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-6">image</div>
            <div class="col-6">login or register form</div>
        </div>
    @endauth
@endsection
