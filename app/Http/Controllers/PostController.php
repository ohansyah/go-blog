<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Libraries\StringTransform;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\UserPost;
use App\Traits\ImageTrait;
use App\Traits\SessionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ImageTrait, SessionTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::with(['postImage', 'category'])
            ->join('user_posts', 'posts.id', '=', 'user_posts.post_id')
            ->where('user_posts.user_id', $user->id)
            ->orderBy('posts.id', 'desc')
            ->simplePaginate($request->get('per_page', 5));

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
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
            $this->flashError($request, $th->getMessage());
        }

        $this->flashSuccess($request);

        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $isUserPost = UserPost::where('user_id', $user->id)
            ->where('post_id', $id)
            ->exists();
        $post = Post::findOrFail($id);

        return view('post.show', compact('post', 'isUserPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $post = Post::join('user_posts', 'posts.id', '=', 'user_posts.post_id')
            ->where('user_posts.user_id', $user->id)
            ->findOrFail($id);

        $categories = Category::all();

        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $post = Post::join('user_posts', 'posts.id', '=', 'user_posts.post_id')
            ->where('user_posts.user_id', $user->id)
            ->findOrFail($id);

        $uploadImage = $this->uploadImage($request, 'image', 'posts');

        try {
            \DB::transaction(function () use ($request, $user, $post, $uploadImage) {
                $post->update($request->only(['category_id', 'title', 'content']));

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
            $this->flashError($request, $th->getMessage());
        }

        $post->refresh();

        $isUserPost = 1;

        $this->flashSuccess($request);

        return view('post.show', compact('post', 'isUserPost'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
