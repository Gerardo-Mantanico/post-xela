<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostView;
use Livewire\Component;

class PostTable extends Component
{
    public $search;
    public function render()
    {
        $post = PostView::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%') // Otro campo
                ->orWhere('id_category', 'like', '%' . $this->search . '%'); // Otro campo
        })
            ->where('state_publication', 'PENDING')
            ->paginate(10);
        return view('livewire.post-table', [
            'post' => $post,
        ]);
    }

    public function changeState($id, $newState)
    {
        $post = Post::find($id);
        if ($post) {
            $post->state_publication = $newState;
            $post->save();
            // session()->flash('message', 'Estado de publicación actualizado con éxito.');
        } else {
            //session()->flash('error', 'Publicación no encontrada.');
        }
    }
}
