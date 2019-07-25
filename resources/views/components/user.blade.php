<div class="d-flex align-items-center">
    <div><img src="{{ $profile->image ?? '/storage/defaults/hashtag.jpg'}}" alt="Profile image" class="rounded-circle w-100 h-100 overflow-hidden"
              style="max-width: 40px; max-height: 40px;"></div>
    <div class="ml-2">
        <a class="text-dark font-weight-bold"
           href="{{ route('profile.index', $profile->user->name ?? $profile->name) }}">{{ $profile->user->name ?? $profile->name }}</a>
        @if($title ?? false)
            {{ $profile->title }}
        @endif
    </div>
</div>