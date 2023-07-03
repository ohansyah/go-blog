<div>
    @foreach ( $comments as $comment )

        <div class="p-2 lg:p-3 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/30 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <h3 class="font-bold">{{ $comment->user->name }}</h3>
                <span class="text-gray-500 dark:text-gray-400 text-right text-xs">{{ $comment->created_at }}</span>
            </div>
            <div class="text-sm">{{ $comment->content }}</div>
        </div>

    @endforeach
</div>
