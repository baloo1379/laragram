<div class="d-flex align-items-center {{ $class ?? '' }}">
    <div><img src="{{ $profile->image ?? '/storage/defaults/default.jpg'}}" alt="Profile image" class="rounded-circle w-100 h-100 overflow-hidden"
              style="max-width: 30px; max-height: 30px;"></div>
    <div class="ml-2">
        <a class="text-dark font-weight-bold"
           href="{{ route('profile.index', $profile->user->name ?? $profile->name) }}">{{ $profile->user->name ?? $profile->name }}</a>
        @if($title ?? false)
            {{ $profile->title }}
        @endif
    </div>
</div>