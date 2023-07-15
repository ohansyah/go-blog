<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\UserPost;
use App\Services\PostService;
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
        try {
            $post = (new PostService())->store($request);
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

        $post = Post::with('postTags.tag')->findOrFail($id);

        return view('post.show', compact('post', 'isUserPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $post = Post::with('postTags.tag')
            ->join('user_posts', 'posts.id', '=', 'user_posts.post_id')
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

        try {
            $post = (new PostService())->update($request, $post);
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
