@extends('layouts.app')

@section('content')
    <div class="d-md-none row">
        <div class="col-3">
            <img src="{{ $profile->getImage() }}" alt="Profile image" class="w-100 rounded-circle border">
        </div>
        <div class="col-9">
            <h2 class="m-0 p-0 mb-2">{{ $profile->user->name }}</h2>
            @auth
                @can('update', $profile)
                    <a class="btn btn-outline-secondary btn-sm w-100" href="{{ route('profile.edit', $profile) }}">Edit
                            profile</a>
                @endcan
                @cannot('update', $profile)
                    <a class="btn btn-primary btn-sm w-100" href="{{ route('follow.user', $profile->user) }}"
                       onclick="event.preventDefault();document.getElementById('follow-form').submit();">
                        {{ auth()->user()->follows($profile->user) ? 'Unfollow' : 'Follow' }}
                    </a>
                    <form id="follow-form" action="{{ route('follow.user', $profile->user) }}" method="post">
                        @csrf
                    </form>
                @endcannot
            @else
                <a class="btn btn-primary btn-sm w-100" href="{{ route('register') }}">Follow</a>
            @endauth
        </div>

        <div class="col-12 mt-3">
            <div class="font-weight-bold">{{ $profile->title }}</div>
            <div><a href="{{ $profile->website }}">{{ $profile->website }}</a></div>
            <div>{!! nl2br(e($profile->biogram)) !!}</div>
        </div>

        <div class="col-12">
            <hr>
        </div>

        <div class="col-4 text-center">
            Posts: <span class="font-weight-bold">{{ $profile->user->posts->count() }}</span>
        </div>
        <div class="col-4 text-center">
            <span class="font-weight-bold">{{ $profile->user->followers->count() }}</span> {{ $profile->user->followers->count() == 1 ? 'follower' : 'followers' }}
        </div>
        <div class="col-4 text-center">
            <span class="font-weight-bold">{{ $profile->user->following->count() }}</span> following
        </div>
    </div>
    <div class="d-none d-md-flex row my-md-5">
        <div class="col-4 d-flex justify-content-center align-items-center">
            <img src="{{ $profile->getImage() }}" alt="Profile image" class="d-block w-100 rounded-circle border "
            style="max-width: 150px;">
        </div>
        <div class="col-8">
            <div class="d-flex align-items-center mb-2">
                <div><h2 class="m-0 p-0">{{ $profile->user->name }}</h2></div>
                @auth
                    @can('update', $profile)
                        <div class="ml-2">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('profile.edit', $profile) }}">Edit profile</a>
                            <form name="delete-all-posts" class="d-inline" action="{{ route('profile.destroyPosts', $profile) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm">Delete all posts</button>
                            </form>
                            <form name="delete-profile" class="d-inline" action="{{ route('profile.destroy', $profile) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete profile</button>
                            </form>
                        </div>
                    @endcan
                    @cannot('update', $profile)
                        <div class="ml-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('follow.user', $profile->user) }}"
                               onclick="event.preventDefault();document.getElementById('follow-form').submit();">
                                {{ auth()->user()->follows($profile->user) ? 'Unfollow' : 'Follow' }}
                            </a>
                            <form id="follow-form" action="{{ route('follow.user', $profile->user) }}" method="post">
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
            @php
                $posts = $profile->user->posts->paginate(9);
            @endphp
            @foreach($posts as $post)
                @component('layouts.post.singleGrid', ['post' => $post])
                @endcomponent
            @endforeach
            <div class="col-md-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection

@section('modal')
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Share</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center"><i class="fab fa-facebook-square fa-2x"></i> <a id="facebook" class="btn btn-link text-dark"> Share on Facebook</a></li>
                        <li class="list-group-item d-flex align-items-center"><i class="fab fa-facebook-messenger fa-2x"></i> <a id="messenger" class="btn btn-link text-dark">Send via Messenger</a></li>
                        <li class="list-group-item d-flex align-items-center"><i class="fab fa-twitter fa-2x"></i> <a id="twitter" class="btn btn-link text-dark"> Twit on Twitter</a></li>
                        <li class="list-group-item d-flex align-items-center"><i class="fas fa-envelope fa-2x"></i> <a id="email" class="btn btn-link text-dark">Send via email</a></li>
                        <li class="list-group-item d-flex align-items-center"><i class="fas fa-link fa-2x"></i> <a id="copy" class="btn btn-link text-dark"> Copy link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
