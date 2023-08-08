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
    public function show(string $id)
    {
        $post = Post::with('postTags.tag')->findOrFail($id);

        return view('public.post.show', compact('post'));
    }

}
