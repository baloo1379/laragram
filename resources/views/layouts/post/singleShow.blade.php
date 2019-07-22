<div class="row">
    <div class="col-12 col-md-8 p-0">
        <img src="{{ $post->image }}" alt="Post image" class="w-100 border">
    </div>
    <div class="col-12 col-md-4 card rounded-0">
        <div class="card-body">
            @component('layouts.user', ['profile' => $post->user->profile])
            @endcomponent
            <div class="mt-2">
                <p>{{ $post->description }}</p>
            </div>
        </div>
    </div>
</div>
