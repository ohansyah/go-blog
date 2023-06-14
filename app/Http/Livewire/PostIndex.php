<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostIndex extends Component
{
    public $posts;
    public function mount($posts)
    {
        $this->posts = $posts;
    }
}
