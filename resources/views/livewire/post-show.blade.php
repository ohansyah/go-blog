<div>
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                {{$post->title}}
                @if($isUserPost)
                    <button type="button" onclick="window.location.href = '{{ route('post.edit', ['post' => $post->id]) }}'" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span class="ml-1"> {{ __('general.edit') }}
                    </button>
                @endif
            </h1>

            <span class="text-gray-500 dark:text-gray-400 text-right">{{ $post->created_at_format_dMY }}</span>
        </div>

        <article class="prose max-w-screen-2xl dark:prose-invert mt-10">{!! $post->content !!}</article>
    </div>
</div>
