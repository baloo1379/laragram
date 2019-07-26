@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            @if( $results->isEmpty() )
                <div class="col-12 d-flex justify-content-center">
                    <div class="text-muted">
                        Nothing was found :(
                    </div>
                </div>
            @else
                <ul class="list-group">
                    @foreach($results as $result)
                        @switch($result->getType())
                            @case("App\User")
                                <li class="list-group-item">
                                    @component('components.user', ['profile' => $result->profile, 'title' => true])@endcomponent
                                </li>
                                @break
                            @case("App\Tag")
                                <li class="list-group-item">
                                    @component('components.tag', ['tagname' => $result->name])@endcomponent
                                </li>
                                @break
                            @default
                        @endswitch

                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
