<div>

    <form>
        <select wire:model="optionCategory" id="optionCategory" class="select select-bordered w-full max-w-xs mb-5 mr-5">
            <option value="all">{{ __('general.all.category') }}</option>
            @foreach ($categories as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>

        <select wire:model="optionTag" id="optionTag" class="select select-bordered w-full max-w-xs mb-5">
            <option value="all">{{ __('general.all.tag') }}</option>
            @foreach ($tags as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <!-- Card 1 -->
            <a href="{{ route('public-post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                    @if ($post->postImage)
                        <img class="w-full h-48 object-cover" src="{{ Storage::url($post->postImage->path) }}"
                            alt="{{ $post->title }}">
                    @else
                        <div class="w-full h-48"
                            style="background-image: url('https://images.unsplash.com/photo-1594729095022-e2f6d2eece9c?w=400'); background-size: cover; position: relative;">

                            <!-- Dark overlay -->
                            <div class="absolute inset-0 bg-black opacity-60"></div>

                            <!-- Overlay div with the post title -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span
                                    class="text-white text-3xl text-center font-semibold px-2">{{ $post->title }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="p-4 flex flex-col justify-between h-72 ">

                        <div>
                            <div class="mb-2">
                                @isset($post->category_name)
                                    <div class="badge badge-outline">{{ $post->category_name }}</div>
                                @endisset
                            </div>

                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $post->title }}</h2>
                            <article class="prose max-w-screen-2xl dark:prose-invert mt-3">{!! $post->content_preview !!}
                            </article>
                        </div>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <span
                                class="text-gray-500 dark:text-gray-400 text-left text-sm ml-1">{{ $post->created_at_format_dMY }}</span>
                        </div>

                    </div>

                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $posts->links() }}
    </div>
</div>
