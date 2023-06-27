<div>
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        
        <x-validation-errors class="mb-4" />
        
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mt-6">
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium">Title</label>
                <input type="text" name="title" id="title" class="form-input mt-1 block w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300" required>
            </div>

            @include('components.form.image-upload')
            
            <div class="mt-6">
                <label for="content" class="block text-gray-700 dark:text-gray-300 font-medium">Content</label>
                <textarea name="content" id="myeditorinstance" class="form-textarea mt-1 block w-full" rows="20"></textarea>
            </div>

            @include('components.form.btn-yes-no', ['route' => 'post.index'])
            
        </form>

    </div>
    
    @include('components.head.tinymce-config')
</div>