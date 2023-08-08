<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PublicPostShow extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = $post;
    }
}