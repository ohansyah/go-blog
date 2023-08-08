<div>
    <div
        class="border-b border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent lg:p-8">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                {{ $post->title }}
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
