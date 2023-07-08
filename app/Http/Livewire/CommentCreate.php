<?php

namespace App\Http\Livewire;

use App\Services\CommentService;
use App\Traits\SessionTrait;
use Livewire\Component;

class CommentCreate extends Component
{
    use SessionTrait;

    public $postId;
    public $content;
    public $comment;

    public function mount($post)
    {
        $this->postId = $post->id;
    }

    protected $rules = [
        'content' => 'required|string|max:510',
    ];

    public function postComment()
    {
        $this->validate([
            'content' => 'required|string|max:510',
        ]);

        $request = [
            'post_id' => $this->postId,
            'content' => $this->content,
        ];
        $this->comment = CommentService::storeFromArray($request);

        $this->content = '';
    }

    public function render()
    {
        return view('livewire.comment-create', [
            'comments' => $this->comment,
        ]);
    }
}
