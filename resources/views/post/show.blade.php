<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('post-show', ['post' => $post, 'isUserPost' => $isUserPost])
            </div>
            
            <div class="divider"></div>
            @livewire('comment-index', ['post' => $post])

            <div class="divider"></div>
            @livewire('comment-create', ['post' => $post])
            
        </div>
    </div>
</x-app-layout>
