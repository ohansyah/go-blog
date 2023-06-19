<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\UserPost;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ImageTrait;

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
            //throw $th;

            // Set a danger banner
            $request->session()->flash('flash.bannerStyle', 'danger');
            $request->session()->flash('flash.banner', $th->getMessage());
        }

        // Set a success banner
        $request->session()->flash('flash.bannerStyle', 'success');
        $request->session()->flash('flash.banner', 'Post created successfully!');

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

        $post->update($request->only(['title', 'content']));
        $isUserPost = 1;
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
