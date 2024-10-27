<?php

namespace App\Livewire;

use App\Models\ReportPost;
use App\Models\ReportPostView;
use App\Models\UserReport;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportPostTable extends Component
{

    public $search = '';
    public $isOpen = false; // Para manejar el estado del modal
    public $isEditMode = false; // Para manejar el modo de edición
    public $repo;
    public $userReport;

    public function render()
    {
        $report = ReportPostView::where('category', 'like', '%' . $this->search . '%')
            ->where('state_report', 'PENDING')
            ->where('no_report', '3')
            ->paginate(2);
        return view('livewire.report-post-table', [
            'report' => $report,
        ]);
    }

    public function details($id)
    {
        $this->isOpen = true;
        $this->isEditMode = true;
        $reportDetails = ReportPostView::find($id);
        $this->repo = $reportDetails;
        $this->userReport = UserReport::where('id_report', $id)->get();
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function changeState($id, $newState)
    {
        $report = ReportPost::find($id);
        if ($report) {
            $report->state_report = $newState;
            $report->save();
            session()->flash('message', 'Estado de reporte actualizado con éxito.');
        } else {
            session()->flash('error', 'reporte no encontrada.');
        }
        $this->isOpen = false;
    }
}
