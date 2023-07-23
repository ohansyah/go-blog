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
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PostService
{
    use ImageTrait, SessionTrait;

    /**
     * Display a listing of the resource.
     * @param array $request
     * @return \Illuminate\Pagination\Paginator
     */
    public static function index(array $request) : Paginator
    {
        $posts = Post::with(['postImage', 'category'])
            ->join('user_posts', 'posts.id', '=', 'user_posts.post_id')
            ->filter($request)
            ->orderBy('posts.id', 'desc')
            ->simplePaginate($request['per_page'] ?? 10);

        return $posts;
    }

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

                $this->manageTag($post, $tags);

                return $post;
            });
        } catch (\Throwable $th) {
            throw $th;
        }

        return $post;
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Post
     */
    public function update(Request $request, $post): Post
    {
        $tags = StringTransform::sExplode($request->get('tags'), ',');

        $uploadImage = $this->uploadImage($request, 'image', 'posts');

        try {
            \DB::transaction(function () use ($request, $post, $tags, $uploadImage) {
                $post->update($request->only(['category_id', 'title', 'content']));

                // delete old tags
                PostTag::where('post_id', $post->id)->delete();
                $this->manageTag($post, $tags);

                if (!$uploadImage) {
                    return $post;
                }

                if ($post->postImage) {
                    $post->postImage()->update([
                        'path' => $uploadImage,
                    ]);
                } else {
                    $post->postImage()->create([
                        'path' => $uploadImage,
                    ]);
                }

            });
        } catch (\Throwable $th) {
            throw $th;
        }

        return $post;
    }

    /**
     * Manage post tags
     * @param \App\Models\Post $post
     * @param array $tags
     */
    private function manageTag($post, $tags): void
    {
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
    }

}
