<div>
    @foreach ($posts as $post)
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                    {{$post->title}}
                </h1>

                <span class="text-gray-500 dark:text-gray-400 text-right">{{ $post->created_at_format_dMY }}</span>
            </div>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                {{$post->content}}
            </p>

            <a href="{{ route('post.show', ['post' => $post->id]) }}" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                {{ __('general.read_more') }}

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>

        </div>
    @endforeach
</div>
