@extends('layouts.app')

@section('content')
    @component('layouts.post.singleShow', ['post' => $post])
    @endcomponent
@endsection
