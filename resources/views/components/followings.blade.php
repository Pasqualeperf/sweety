<h3 class="mb-4 font-bold text-xl">Followings</h3>
<ul>
    @foreach (auth()->user()->follows as $user)
        <li class="mb-4">
            <div class="flex items-center">
                <a href="{{$user->toProfile()}}"><img class="rounded-full w-12 mr-2" src="{{$user->showAvatar()}}" alt="{{$user->name}} avatar"></a>
                <a href="{{$user->toProfile()}}">
                    <p class="text-sm">{{$user->name}}</p>
                </a>
            </div>
        </li>
    @endforeach
</ul>
