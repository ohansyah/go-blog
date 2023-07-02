<div>
    @foreach ( $comments as $comment )

        <div class="p-2 lg:p-3 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/30 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div>
                <h3 class="font-bold">{{ $comment->user->name }}</h3>
                <div class="text-sm">{{ $comment->content }}</div>
            </div>
        </div>

    @endforeach
</div>
