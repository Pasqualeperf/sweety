<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class="lg:flex lg:justify-between max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="lg:w-1/6">
            <x-sidebar></x-sidebar>
        </div>
        <div class="lg:flex-1 lg:mx-10" style="max-width: 700px">
            <header class="relative">
                <div class="h-60 rounded-lg mb-3" style="background: lightblue url('{{$user->showProfileCover()}}'); background-repeat:no-repeat; background-size:cover;"></div>
                <div class="flex justify-between p-3 items-center">
                    <div>
                        <h3 class="font-bold text-2xl">{{$user->name}}</h3>
                        <p class="text-sm">Joined {{$user->created_at->diffForHumans()}}</p>
                    </div>
                    <div>
                        @if (Auth::id() != $user->id)
                            <form action="{{route('toggle', $user->slug)}}" method="POST">
                                @csrf
                                <button class="bg-blue-500 rounded-xl text-white px-4 py-2 shadow" type="submit">{{Auth::user()->following($user) ? 'Unfollow' : 'Follow'}}</button>
                            </form>
                        @else
                            <form action="{{route('edit-profile', $user->slug)}}" method="GET">
                                <button class="bg-blue-500 rounded-xl text-white px-4 py-2 shadow" type="submit">Edit profile</button>
                            </form>
                        @endif
                    </div>
                </div>
                <img class="rounded-full w-32 absolute border-8 border-white" src="{{$user->showAvatar()}}" alt="{{$user->name}} avatar" style="top: 50%; left: calc(50% - 4rem);">
            </header>
            <div class="border border-gray-300 rounded-lg mt-6 py-4">
                <x-timeline :tweets="$tweets"></x-timeline>
            </div>
        </div>
        <div class="lg:w-44 bg-blue-100 rounded-lg p-4">
            <x-followings></x-followings>
        </div>
    </div>
</x-app-layout>
