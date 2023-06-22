<div>
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        
        <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium">Title</label>
                <input type="text" name="title" id="title" value="{{$post->title}}" class="form-input mt-1 block w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300" required>
            </div>

            @include('components.form.image-upload')

            <div class="mt-6">
                <label for="content" class="block text-gray-700 dark:text-gray-300 font-medium">Content</label>
                <textarea name="content" id="myeditorinstance" class="form-textarea mt-1 block w-full" rows="20" required>{{$post->content}}</textarea>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                    {{__('general.submit')}}
                </button>
                <a href="{{ route('post.show', ['post' => $post->id]) }}" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                    {{__('general.back')}}
                </a>
            </div>
        </form>

    </div>
    @include('components.head.tinymce-config')
</div>