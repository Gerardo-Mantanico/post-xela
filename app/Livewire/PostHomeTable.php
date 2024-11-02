<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostHomeTable extends Component
{
    public $search = '';
    public function render()
    {
        $post = Post::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%') // Otro campo
                ->orWhere('id_category', 'like', '%' . $this->search . '%'); // Otro campo
        })
            ->where('state_publication', 'ACTIVATED')
            ->paginate(10);
        return view('livewire.post-home-table', [
            'post' => $post,
        ]);
    }
}
