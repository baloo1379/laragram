@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            @if( $users->isEmpty() )
                <div class="col-12 d-flex justify-content-center">
                    <div class="text-muted">
                        No user was found :(
                    </div>
                </div>
            @else
                <ul class="list-group">
                    @foreach($users as $user)
                        <li class="list-group-item">
                            @component('components.user', ['profile' => $user->profile, 'title' => true])@endcomponent
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
