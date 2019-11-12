<article class="row">
    <div class="col-12 col-md-8 pr-md-0">
        <img src="{{ $post->image }}" alt="Post image" class="w-100 border">
    </div>
    <div class="col-12 col-md-4 rounded-0 pl-md-0">
        <div class="border bg-white h-100 d-flex flex-column">
            @component('components.user', ['profile' => $post->user->profile, 'class' => 'p-3 border-bottom'])
            @endcomponent
            <div class="border-bottom py-3 flex-shrink-1 flex-grow-1 overflow-auto comments-flex-basis" >
                <ul class="list-unstyled m-0">
                    <div class="pb-2 px-3 d-flex w-100">
                        <div class="mr-3">
                            <img src="{{ $post->user->profile->image ?? '/storage/defaults/default.jpg'}}" alt="Profile image" class="rounded-circle overflow-hidden"
                                 style="width: 30px; height: 30px;">
                        </div>
                        <div>
                            <a class="text-dark font-weight-bold"
                               href="{{ route('profile.index', $post->user->name) }}">{{ $post->user->name }}</a>
                            <span style="word-wrap: break-word; word-break: break-word;">@component('tag.tag', ['desc' => $post->description])
                                @endcomponent</span>
                            <br><small>{{ $post->created_at->diffForHumans() }}</small>
                        </div>

                    </div>

                    @foreach($post->comments as $comment)
                        <li class="py-2 px-3 d-flex">
                            <div class="mr-3">
                                <img src="{{ $comment->user->profile->getImage() }}" alt="Profile image" class="rounded-circle overflow-hidden"
                                     style="width: 30px; height: 30px;">
                            </div>
                            <div>
                                <a class="text-dark font-weight-bold"
                                   href="{{ route('profile.index', $comment->user->name) }}">{{ $comment->user->name }}</a>
                                <span style="word-wrap: break-word; word-break: break-word;"> @component('tag.tag', ['desc' => $comment->content])
                                    @endcomponent</span>
                                <br><small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>



            </div>
            <div class="border-bottom p-3">
                <a href="#" class="btn btn-link text-dark text-decoration-none p-1"><i class="far fa-heart fa-2x"></i></a>
                <a class="btn btn-link text-dark text-decoration-none p-1" href="#comment"><i class="far fa-comment fa-2x"></i></a>
                <button class="btn btn-link text-dark text-decoration-none share-button p-1" data-toggle="modal" data-target="#shareModal" data-url="{{ route('post.show', $post->id) }}"><i class="far fa-share-square fa-2x"></i></button>
                <br><small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
            <div class="border-bottom position-relative">
                <form name="comment-form" id="comment-form" action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input class="border-0 w-100 p-3 pr-5" type="text" name="content" id="comment" placeholder="Add comment..." autocomplete="off">
                    <button type="submit" class="btn btn-link p-3 position-absolute" style="right: 0; top: 0;"><i class="far fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</article>
