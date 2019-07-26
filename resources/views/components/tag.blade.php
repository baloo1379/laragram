<div class="d-flex align-items-center">
    <div><img src="/storage/defaults/hashtag.jpg" alt="Profile image" class="rounded-circle w-100 h-100 overflow-hidden"
              style="max-width: 40px; max-height: 40px;"></div>
    <div class="ml-2">
        <div>
            <a class="text-dark font-weight-bold"
               href="{{ (route('tag.show', urlencode($tagname))) }}">{{ $tagname }}</a>
        </div>
        @if($username ?? false)
            <div>
                <a href="{{ route('profile.index', $username) }}" class="text-dark">{{ $username }}</a>
            </div>
        @endif
    </div>
</div>