<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ActivityLog;


#[Layout('layouts.app')]
class ActivityLogs extends Component
{
    public $logs;

    public function mount()
    {
        // Fetch all activity logs, you can modify this query based on your needs
        $this->logs = ActivityLog::latest()->get();
    }

    public function render()
    {
        return view('livewire.activity-logs', [
            'logs' => $this->logs, // Passing logs to the view
        ]);
    }
}
