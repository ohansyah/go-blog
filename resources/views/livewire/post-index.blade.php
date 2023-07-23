<div>

    <form>
        <select wire:model="optionCategory" id="optionCategory"  class="select select-bordered w-full max-w-xs mb-5 mr-5">
            <option value="all">{{ __('general.all') }}</option>
            @foreach($categories as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>

        <select wire:model="optionTag" id="optionTag"  class="select select-bordered w-full max-w-xs mb-5">
            <option value="all">{{ __('general.all') }}</option>
            @foreach($tags as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </form>


    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        @foreach ($posts as $post)
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

            <a href="{{ route('post.show', ['post' => $post->id]) }}">

                @if($post->postImage)
                <div class="flex">
                    <div class="w-2/3">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                                {{$post->title}}
                            </h1>
                        </div>
                        <span class="text-gray-500 dark:text-gray-400 text-right text-sm">{{ $post->created_at_format_dMY }}</span>

                        @if ($post->category_name)
                        <div class="badge badge-outline">{{ $post->category_name }}</div>
                        @endif

                        <article class="prose max-w-screen-2xl dark:prose-invert mt-3">{!! $post->content_preview !!}</article>
                    </div>

                    <div class="w-1/3 ml-6">
                        <img src="{{ asset('storage/' . $post->postImage->path) }}" alt="Preview" class="mt-2 max-h-60 object-cover rounded-md mx-auto">
                    </div>
                </div>
                @else
                <div class="">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                            {{$post->title}}
                        </h1>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400 text-right text-sm">{{ $post->created_at_format_dMY }}</span>

                    @if ($post->category_name)
                    <div class="badge badge-outline">{{ $post->category_name }}</div>
                    @endif

                    <article class="prose max-w-screen-2xl dark:prose-invert mt-3">{!! $post->content_preview !!}</article>
                </div>
                @endif

            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</div>
