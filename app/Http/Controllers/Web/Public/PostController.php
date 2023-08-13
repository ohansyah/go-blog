<?php

namespace App\Http\Controllers\Web\Public;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('public.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $slug)
    {
        $post = Post::with('postTags.tag')->findOrFail($id);

        // Verify if the provided slug matches the actual post's slug
        if ($slug !== $post->slug) {
            // If the slugs don't match, perform a 301 redirect to the correct URL
            return redirect()->route('public-post.show', ['id' => $post->id, 'slug' => $post->slug], 301);
        }

        return view('public.post.show', compact('post'));
    }

}
