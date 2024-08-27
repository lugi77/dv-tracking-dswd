<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTable extends Component
{
    use WithPagination;

    public $name, $email, $dswd_id, $section;

    // This property will be used to confirm approval actions
    public $selectedUserId;

    public function render()
    {
        $users = User::where('section', '!=', 0)->paginate(10);

        return view('livewire.admin.admin-table', ['users' => $users]);
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
}
