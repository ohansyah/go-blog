<div>
    <div
        class="border-b border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent lg:p-8">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                {{ $post->title }}
                @if ($isUserPost)
                    <button type="button"
                        onclick="window.location.href = '{{ route('post.edit', ['post' => $post->id]) }}'"
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span class="ml-1"> {{ __('general.edit') }}
                    </button>
                @endif
            </h1>

            <span class="text-right text-gray-500 dark:text-gray-400">{{ $post->created_at_format_dMY }}</span>
        </div>

        <div class="badge badge-outline">{{ $post->category_name }}</div>

        @if ($post->postImage)
            <div class="mt-6">
                <img src="{{ asset('storage/' . $post->postImage->path) }}" alt="Preview"
                    class="mx-auto mt-2 max-h-60 rounded-md object-cover">
            </div>
        @endif

        <article class="prose mt-10 max-w-screen-2xl dark:prose-invert">{!! $post->content !!}</article>

        @if ($post->postTags->count())
            <div class="mt-6">
                <div class="font-medium text-gray-700 dark:text-gray-300">Tags :</div>
                <div class="flex flex-wrap">
                    @foreach ($post->postTags as $postTag)
                        <div class="badge badge-neutral">{{ $postTag->tag->name }}</div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
