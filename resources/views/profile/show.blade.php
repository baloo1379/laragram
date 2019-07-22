@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-4 col-md-3">
            <img src="{{ $profile->image }}" alt="Profile image" class="w-100 rounded-circle border">
        </div>
        <div class="col-8 col-md-9">
            <div class="d-flex align-items-center mb-2">
                <div><h2 class="m-0 p-0">{{ $profile->user->name }}</h2></div>
                @auth
                    @can('update', $profile)
                        <div class="ml-2">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('profile.edit', $profile) }}">Edit
                                profile</a>
                        </div>
                    @endcan
                    @cannot('update', $profile)
                        <div class="ml-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('follow', $profile->user) }}"
                               onclick="event.preventDefault();document.getElementById('follow-form').submit();">
                                {{ auth()->user()->follows($profile->user) ? 'Unfollow' : 'Follow' }}
                            </a>
                            <form id="follow-form" action="{{ route('follow', $profile->user) }}" method="post">
                                @csrf
                            </form>
                        </div>
                    @endcannot
                @else
                    <div class="ml-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Follow</a>
                    </div>
                @endauth
            </div>
            <div class="d-flex flex-column flex-sm-row">
                <div class="mr-5">Posts: <span class="font-weight-bold">{{ $profile->user->posts->count() }}</span>
                </div>
                <div class="mr-5"><span
                            class="font-weight-bold">{{ $profile->user->followers->count() }}</span> {{ $profile->user->followers->count() == 1 ? 'follower' : 'followers' }}
                </div>
                <div><span class="font-weight-bold">{{ $profile->user->following->count() }}</span> following</div>
            </div>
            <div>
                <p class="font-weight-bold">{{ $profile->title }}</p>
                <a href="{{ $profile->website }}">{{ $profile->website }}</a>
                <p>{!! nl2br(e($profile->biogram)) !!}</p>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        @if( $profile->user->posts->isEmpty() )
            <div class="col-12 d-flex justify-content-center">
                <div class="text-muted">
                    empty
                </div>
            </div>
        @else
            @foreach($profile->user->posts as $post)
                @component('layouts.post.singleProfile', ['post' => $post])
                @endcomponent
            @endforeach
        @endif
    </div>

@endsection
