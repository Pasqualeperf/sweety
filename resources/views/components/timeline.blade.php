@forelse ($tweets as $tweet)
    <div class="flex {{$loop->last ? '' : 'border-b border-gray-300'}}  px-4 py-6">
        <div class="mr-4 flex-shrink-0">
            <a href="{{route('profile', $tweet->user->slug)}}"><img class="rounded-full w-14" src="{{$tweet->user->showAvatar()}}" alt="{{$tweet->user->name}} avatar"></a>
        </div>
        <div>
            <a href="{{route('profile', $tweet->user->slug)}}">
                <h5 class="font-bold mb-2">{{$tweet->user->name}}</h5>
            </a>
            <p class="text-sm">
                {{$tweet->body}}
            </p>
            <div class="flex mt-2">
                <form action="{{route('like-tweet', $tweet->id)}}" method="POST">
                    @csrf
                    <div class="mr-2 {{ auth()->user()->likeTweet($tweet) ? 'text-blue-500' : '' }}">
                        <button type="submit"><i class="fas fa-thumbs-up {{ auth()->user()->likeTweet($tweet) ? 'text-blue-500' : 'text-gray-300' }}"></i></button>
                        <span class="text-xs">{{$tweet->likes_count}}</span>
                    </div>
                </form>
                <form action="{{route('dislike-tweet', $tweet->id)}}" method="POST">
                    @csrf
                    <div class="{{ auth()->user()->dislikeTweet($tweet) ? 'text-red-500' : '' }}">
                        <button type="submit"><i class="fas fa-thumbs-down {{ auth()->user()->dislikeTweet($tweet) ? 'text-red-500' : 'text-gray-300' }}"></i></button>
                        <span class="text-xs">{{$tweet->dislike_count}}</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@empty
    No Tweets published at moment!
@endforelse
