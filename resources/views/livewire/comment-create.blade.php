<div>

    <x-validation-errors class="mb-4" />

    <form wire:submit.prevent="postComment">
        @csrf

        <div class="form-control">
            <input type="hidden" name="post_id" id="post_id" wire:model="post_id" value="{{ $postId }}">
            <textarea name="content" id="content" wire:model.debounce.1000ms="content" class="textarea textarea-bordered h-24" placeholder="{{ __('general.placeholder') }}"></textarea>
        </div>

        @include('components.form.btn-yes-no', ['route' => 'post.index'])

    </form>

</div>
