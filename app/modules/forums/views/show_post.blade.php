<div class="post">
    <div class="meta">
        <a href="{{ url('users/'.$forumPost->creator->id.'/'.$forumPost->creator->slug) }}">
            <span class="username" title="{{{ $forumPost->creator->username }}}">{{{ $forumPost->creator->username }}}</span>
            @if ($forumPost->creator->avatar)
            <img class="avatar" src="{{{ $forumPost->creator->uploadPath().$forumPost->creator->avatar }}}" alt="{{{ $forumPost->creator->username }}}">
            @endif
            <span class="counter">{{{ $forumPost->creator->posts_count }}} Posts</span>
        </a>
    </div>
    <div class="content">
        <div class="top-bar">
            <span class="date-time">{{ $forumPost->created_at->dateTime() }}</span>
            <div class="buttons">
                @if (user())
                    @if (user()->hasAccess('forums', PERM_UPDATE) or $forumPost->creator->id == user()->id)
                        <a href="{{ url('forums/posts/edit/'.$forumPost->id) }}">{{ trans('app.edit') }}</a>
                    @endif
                    @if (! $forumPost->root and (user()->hasAccess('forums', PERM_DELETE) or $forumPost->creator->id == user()->id))
                        <a href="{{ url('forums/posts/delete/'.$forumPost->id) }}">{{ trans('app.delete') }}</a>
                    @endif
                    <a class="quote" href="#">{{ trans('forums::quote') }}</a>
                @endif
                <a href="{{ url('forums/posts/perma/'.$forumPost->id) }}"> 
                    @if (isset($forumPostNumber))
                        #{{ $forumPostNumber }}
                    @else
                        #
                    @endif
                </a>
            </div>
        </div>
        <div class="text">
            {{ $forumPost->renderText() }}
        </div>
        @if ($forumPost->updater_id and $forumPost->updated_at->diffInMinutes($forumPost->created_at) > 0)
        <div class="updated">
            {{ trans('forums::updated_at', [$forumPost->updated_at->dateTime()]) }}
        </div>
        @endif
    </div>
</div>