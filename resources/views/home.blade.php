<x-app-layout>
    <div class="lg:flex lg:justify-between max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="lg:w-1/6">
            <x-sidebar></x-sidebar>
        </div>
        <div class="lg:flex-1 lg:mx-10" style="max-width: 700px">
            <div>
                <x-tweet-form></x-tweet-form>
            </div>
            <div class="border border-gray-300 rounded-lg mt-6 py-4">
                <x-timeline :tweets="$tweets"></x-timeline>
            </div>
        </div>
        <div class="lg:w-44 bg-blue-100 rounded-lg p-4">
            <x-followings></x-followings>
        </div>
    </div>
</x-app-layout>
