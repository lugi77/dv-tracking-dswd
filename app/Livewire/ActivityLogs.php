<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Include pagination trait
use App\Models\ActivityLog;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ActivityLogs extends Component
{
    use WithPagination;

    public $selectedLogs = []; // To hold selected logs for bulk delete
    public $selectAll = false;

    // To refresh the pagination view after a bulk delete action
    protected $listeners = ['deleteSelected'];

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLogs = ActivityLog::pluck('id')->toArray(); // Select all log IDs
        } else {
            $this->selectedLogs = [];
        }
    }

    public function deleteSelected()
    {
        ActivityLog::whereIn('id', $this->selectedLogs)->delete(); // Delete selected logs
        $this->selectedLogs = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected logs deleted successfully.'); // Flash message
        $this->dispatch('refreshComponent'); // Refresh component
    }

    public function deleteAll()
    {
        ActivityLog::truncate(); // Delete all logs
        session()->flash('message', 'All logs deleted successfully.'); // Flash message
        $this->dispatch('refreshComponent'); // Refresh component
    }

    public function render()
    {
        $logs = ActivityLog::latest()->paginate(10); // Fetch paginated logs

        return view('livewire.activity-logs', [
            'logs' => $logs,
        ]);
    }
}
