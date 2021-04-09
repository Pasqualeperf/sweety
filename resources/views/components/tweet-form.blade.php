<div class="rounded-lg border border-blue-500 px-8 py-6">
    <form method="POST" action="{{route('tweet-store')}}">
        @csrf

        <textarea name="body" id="sweetMessageBody" class="w-full resize-none border-0 focus:ring-transparent" placeholder="Publish a sweety!"></textarea>
        @error('body')
            <span class="text-red-500 font-sm">Hey boss don't forget this field!</span>
        @enderror
        <hr class="my-4">
        <footer class="flex justify-between">
            <img class="rounded-full w-12 mr-2" src="{{auth()->user()->showAvatar()}}" alt="{{auth()->user()->name}} avatar">
            <button class="bg-blue-500 rounded-xl text-white px-4 py-2 shadow" type="submit">Sweet!</button>
        </footer>
    </form>
</div>
