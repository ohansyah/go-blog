<div>

    @if($comment)
        <div class="animate-fade-in opacity-100">
            <div class="mb-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-2 lg:p-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/30 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold">{{ $comment->user->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 dark:text-gray-400 text-right text-xs mx-3">{{ $comment->created_at }}</span>
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                            </span> 
                        </div>
                    </div>
                    <div class="text-sm">{{ $comment->content }}</div>
                </div>
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
