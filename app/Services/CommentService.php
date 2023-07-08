<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class CommentService
{
    /**
     * Display a listing of the resource.
     * @param $postId
     * @param int paginate
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public static function index($postId, $paginate = 10)
    {
        $comments = Comment::with(['user'])
            ->where('post_id', $postId)
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->paginate($paginate);

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

    public static function storeFromArray($data)
    {
        $user = Auth::user();
        $post = Post::findOrFail($data['post_id']);

        $data['user_id'] = $user->id;

        return DB::transaction(function () use ($data, $post) {
            $comment = Comment::create($data);
            $post->comments()->save($comment);
            return $comment;
        });
    }
}
