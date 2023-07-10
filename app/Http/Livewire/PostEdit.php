<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $categories;

    public function mount($post, $categories)
    {
        $this->post = $post;
        $this->categories = $categories;
    }
}
