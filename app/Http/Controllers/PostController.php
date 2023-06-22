<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
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
    public function index()
    {
        $user = Auth::user();
        $posts = Post::join('user_posts', 'posts.id', '=', 'user_posts.post_id')
            ->where('user_posts.user_id', $user->id)
            ->get();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user();

        $uploadImage = $this->uploadImage($request, 'image', 'posts');

        try {
            $post = \DB::transaction(function () use ($request, $user, $uploadImage) {
                $post = Post::create($request->only(['title', 'content']));

                $post->postImage()->create([
                    'path' => $uploadImage,
                ]);

                UserPost::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);

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
        return view('post.edit', compact('post'));
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
                $post->update($request->only(['title', 'content']));

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
