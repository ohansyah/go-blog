<div>
    <x-validation-errors class="mb-4" />

    <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-control">
            <input type="hidden" name="post_id" id="post_id" value="{{ $postId }}">
            <textarea name="content" id="content" class="textarea textarea-bordered h-24" placeholder="{{ __('general.placeholder') }}"></textarea>
        </div>

        @include('components.form.btn-yes-no', ['route' => 'post.index'])

    </form>

</div>
