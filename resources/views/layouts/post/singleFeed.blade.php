<div class="card mb-2 {{ $classes ?? '' }}">
    <div class="card-body p-3">
        @if(!$post->getTagOrigin())
            @component('components.user', ['profile' => $post->user->profile])
            @endcomponent
        @else
            @component('components.tag', ['tagname' => $post->getTagOrigin(), 'username' => $post->user->name])
            @endcomponent
        @endif
    </div>

    <img src="{{ $post->image }}" alt="Post image" class="w-100">
    <div class="card-body p-2 border-top">
        <div class="">
            <a href="#" class="btn btn-link text-dark text-decoration-none p-1"><i class="far fa-heart fa-2x"></i></a>
            <a class="btn btn-link text-dark text-decoration-none p-1" href="{{ route('post.show', $post) }}"><i class="far fa-comment fa-2x"></i></a>
            <button class="btn btn-link text-dark text-decoration-none share-button p-1" data-toggle="modal" data-target="#shareModal" data-url="{{ route('post.show', $post->id) }}"><i class="far fa-share-square fa-2x"></i></button>
        </div>
        <div>
            <a class="text-dark font-weight-bold"
               href="{{ route('profile.index', $post->user->name) }}">{{ $post->user->name }}</a>
            @component('tag.tag', ['desc' => $post->description])
            @endcomponent
            <div><small>{{ $post->created_at->diffForHumans() }}</small></div>
        </div>
        @if(!$post->comments->isEmpty())
            <div class="d-flex border-top p-2 align-items-center">
                <div class="mr-3">
                    <img src="{{ $post->comments()->first()->user->profile->image ?? '/storage/defaults/default.jpg'}}" alt="Profile image" class="rounded-circle overflow-hidden"
                         style="width: 30px; height: 30px;">
                </div>

                <div>
                    <a class="text-dark font-weight-bold"
                       href="{{ route('profile.index', $post->comments()->first()->user->name) }}">{{ $post->comments()->first()->user->name }}</a>
                    <span style="word-wrap: break-word; word-break: break-word;">
                        @component('tag.tag', ['desc' => $post->comments()->first()->content])
                        @endcomponent
                    </span>
                    <br><small>{{ $post->comments()->first()->created_at->diffForHumans() }}</small>
                </div>



            </div>
            @if($post->comments->count() > 1)
            <div class="ml-2">
                <a href="{{ route('post.show', $post) }}">Więcej komentarzy...</a>
            </div>
            @endif
        @endif
    </div>
</div>