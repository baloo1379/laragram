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
