<div class="d-none d-md-block col-md-4 mb-md-4">
    <a href="/post/{{ $post->id }}"><img src="{{ $post->image }}" alt="post" class="w-100"></a>
</div>
@component('layouts.post.singleFeed', [
'post' => $post,
'classes' => 'd-md-none'
])
@endcomponent
