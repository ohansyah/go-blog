<?php

namespace App\Services;

use App\Libraries\StringTransform;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\UserPost;
use App\Traits\ImageTrait;
use App\Traits\SessionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class PostService
{
    use ImageTrait, SessionTrait;

    /**
     * Store a new post
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Post
     */
    public function store(Request $request): Post
    {
        $user = Auth::user();

        $tags = StringTransform::sExplode($request->get('tags'), ',');

        $uploadImage = $this->uploadImage($request, 'image', 'posts');

        try {
            $post = \DB::transaction(function () use ($request, $user, $tags, $uploadImage) {
                $post = Post::create($request->only(['category_id', 'title', 'content']));

                $post->postImage()->create([
                    'path' => $uploadImage,
                ]);

                UserPost::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);

                // get existing tags
                $existingTags = Tag::whereIn('name', $tags)->get();

                // store new tags
                $newTags = array_diff($tags, $existingTags->pluck('name')->toArray());
                foreach ($newTags as $newTag) {
                    $tag = Tag::create([
                        'name' => $newTag,
                    ]);

                    $existingTags->push($tag);
                }

                // prepare bulk create post tags
                $postTags = [];
                foreach ($existingTags as $existingTag) {
                    $postTags[] = [
                        'post_id' => $post->id,
                        'tag_id' => $existingTag->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // bulk create post tags
                PostTag::insert($postTags);

                return $post;
            });
        } catch (\Throwable $th) {
            throw $th;
        }

        return $post;
    }

}
