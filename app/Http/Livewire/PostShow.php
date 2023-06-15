<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public $isUserPost;
    public function mount($post, $isUserPost)
    {
        $this->post = $post;
        $this->isUserPost = $isUserPost;
    }
}
