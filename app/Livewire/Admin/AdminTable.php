<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\CombinedExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminTable extends Component
{
    use WithPagination;

    public $name, $email, $dswd_id, $section;
    public $search = ''; // New search property
    // This property will be used to confirm approval actions
    public $selectedUserId;
    public $showPendingOnly = false;


    public function render()
    {
        $query = User::where('section', '!=', 0)
        ->orderBy('is_approved', 'desc'); // Approved users will be at the top

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('dswd_id', 'like', '%' . $this->search . '%');
            });
        }

        // Apply filter if showPendingOnly is true
        if ($this->showPendingOnly) {
            $query->where('is_approved', false);
        }

        $users = $query->paginate(10);

        return view('livewire.admin.admin-table', ['users' => $users]);
    }

    public function togglePendingFilter()
    {
        $this->showPendingOnly = !$this->showPendingOnly;
    }

    /**
     * Approve a user by setting is_approved to true
     */
    public function approveUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_approved = true;
        $user->save();

        session()->flash('message', 'User approved successfully.');
    }

    /**
     * Deny a user by setting is_approved to false
     */
    public function denyUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_approved = false;
        $user->save();

        session()->flash('message', 'User denied successfully.');
    }
    public function export()
    {
        return Excel::download(new CombinedExport, 'combined_data.xlsx');
    }
}
