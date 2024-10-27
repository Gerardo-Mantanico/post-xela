<?php

namespace App\Livewire;

use App\Models\EventView;
use Livewire\Component;

class AttendEventTable extends Component
{
    public $search = '';
    public $isOpen = false; // Para manejar el estado del modal
    public $isEditMode = false; // Para manejar el modo de edición



    public function render()
    {

        $event = EventView::where('title', 'like', '%' . $this->search . '%')
            ->paginate(4);

        return view('livewire.attend-event-table', [
            'event' => $event,
        ]);
    }
}
