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
            <div class="col-12 col-md-6">
                <div class="jumbotron">
                    <h1 class="display-4">Laragram</h1>
                    <p class="lead">A simplified clone of instagram created with <a href="https://github.com/laravel">@laravel</a></p>
                    <hr class="my-4">
                    <p>This application is open-source. You can find her code on Github</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="https://github.com/baloo1379/laragram" role="button">baloo1379/laragram</a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
