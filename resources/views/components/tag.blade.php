<div class="d-flex align-items-center">
    <div><img src="/storage/defaults/hashtag.jpg" alt="Profile image" class="rounded-circle w-100 h-100 overflow-hidden"
              style="max-width: 40px; max-height: 40px;"></div>
    <div class="ml-2">
        <a class="text-dark font-weight-bold"
           href="{{ route('tag.show', substr($tag->name, 1)) }}">{{ $tag->name }}</a>
    </div>
</div>