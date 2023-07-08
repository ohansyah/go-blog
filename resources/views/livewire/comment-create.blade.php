<div>

    @if($comment)
        <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-2 lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/30 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold">{{ $comment->user->name }}</h3>
                    <span class="text-gray-500 dark:text-gray-400 text-right text-xs">{{ $comment->created_at }}</span>
                </div>
                <div class="text-sm">{{ $comment->content }}</div>
            </div>
        </div>
    @endif

    <x-validation-errors class="mb-4" />

    <form wire:submit.prevent="postComment">
        @csrf

        <div class="form-control">
            <input type="hidden" name="post_id" id="post_id" wire:model="post_id" value="{{ $postId }}">
            <textarea name="content" id="content" wire:model="content" class="textarea textarea-bordered h-24" placeholder="{{ __('general.placeholder') }}"></textarea>
        </div>

        @include('components.form.btn-yes-no', ['route' => 'post.index'])

    </form>

</div>
