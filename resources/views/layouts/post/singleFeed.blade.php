<div class="card mb-2 {{ $classes ?? '' }}">
    <div class="card-body p-3">
        @component('components.user', ['profile' => $post->user->profile])
        @endcomponent
    </div>

    <img src="{{ $post->image }}" alt="Post image" class="w-100">
    <div class="card-body p-3 border-top">
        <div class="mb-3">
            Like
            <a href="{{ route('post.show', $post) }}">View</a>
            Share
        </div>
        <div>
            <a class="text-dark font-weight-bold"
               href="{{ route('profile.index', $post->user->name) }}">{{ $post->user->name }}</a>
            @component('tag.tag', ['desc' => $post->description])
            @endcomponent
        </div>
    </div>
</div>
