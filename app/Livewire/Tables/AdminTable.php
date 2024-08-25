<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class AdminTable extends Component
{
    use WithPagination;
    public function render()
    {
        $users = User::where('section', '!=', 0)->paginate(10);

        return view('livewire.tables.admin-table', ['users' => $users]);
        
    }
}
