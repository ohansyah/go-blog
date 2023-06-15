<div>
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
    </div>
</div>
