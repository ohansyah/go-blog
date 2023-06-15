<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
}
