<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('public-post-show', ['post' => $post])
            </div>

            <div class="divider"></div>
            @livewire('comment-index', ['post' => $post])
        </div>
    </div>
</x-guest-layout>
