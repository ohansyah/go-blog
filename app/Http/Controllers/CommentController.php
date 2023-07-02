<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\SessionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use SessionTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        // $request->validated();
        $user = Auth::user();
        $post = Post::findOrFail($request->post_id);

        try {
            // append user_id to request
            $request->merge(['user_id' => $user->id]);

            DB::transaction(function () use ($request, $post) {
                $comment = Comment::create($request->only(['parent_id', 'post_id', 'user_id', 'content']));
                $post->comments()->save($comment);
                return $comment;
            });

            $this->flashSuccess($request);
        } catch (\Throwable $th) {
            $this->flashError($request, $th->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
