<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class CommentService
{
    public static function index($postId)
    {
        $comments = Comment::with(['user'])
            ->where('post_id', $postId)
            ->whereNull('parent_id')
            ->get();

        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(Request $request)
    {
        $user = Auth::user();
        $post = Post::findOrFail($request->post_id);

        // append user_id to request
        $request->merge(['user_id' => $user->id]);

        DB::transaction(function () use ($request, $post) {
            $comment = Comment::create($request->only(['parent_id', 'post_id', 'user_id', 'content']));
            $post->comments()->save($comment);
            return $comment;
        });

    }
}
