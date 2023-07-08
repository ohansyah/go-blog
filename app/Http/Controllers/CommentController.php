<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Traits\SessionTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use SessionTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        try {
            CommentService::store($request);
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
