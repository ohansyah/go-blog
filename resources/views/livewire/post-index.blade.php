<div>
    @foreach ($posts as $post)
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

        <a href="{{ route('post.show', ['post' => $post->id]) }}">
            <span class="text-gray-500 dark:text-gray-400 text-right text-sm">{{ $post->created_at_format_dMY }}</span>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                    {{$post->title}}
                </h1>
            </div>

            @if($post->postImage)
                <div class="flex mt-6">
                    <div class="w-2/3">
                        <article class="prose max-w-screen-2xl dark:prose-invert mt-3">{!! $post->content !!}</article>
                    </div>

                    <div class="w-1/3 ml-6">
                        <img src="{{ asset('storage/' . $post->postImage->path) }}" alt="Preview" class="mt-2 max-h-60 object-cover rounded-md mx-auto">
                    </div>

                </div>
            @else
                <div class="mt-6">
                    <article class="prose max-w-screen-2xl dark:prose-invert mt-3">{!! $post->content !!}</article>
                </div>
            @endif

        </a>
    </div>

    @endforeach
</div>
