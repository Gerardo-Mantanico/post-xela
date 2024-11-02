<?php

namespace App\Livewire;

use App\Models\EventView;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AttendEventTable extends Component
{
    public $search = '';
    public $isOpen = false;
    public $isEditMode = false;

    public function render()
    {
        $event = EventView::where('title', 'like', '%' . $this->search . '%')
            ->where('user', Auth::id())
            ->orderBy('created_at', 'desc')->paginate(3);

        return view('livewire.attend-event-table', [
            'event' => $event,
        ]);
    }
}
