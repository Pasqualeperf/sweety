<ul>
    <li class="mb-4">
        <div class="flex items-center">
            <a href="{{route('profile', $user->slug)}}"><img class="rounded-full w-12 mr-2" src="{{$user->showAvatar()}}" alt="{{$user->name}} avatar"></a>
            <a href="{{route('profile', $user->slug)}}">
                <p class="text-sm">{{$user->name}}</p>
            </a>
        </div>
    </li>
</ul>
