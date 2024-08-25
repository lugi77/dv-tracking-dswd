<?php

namespace App\Livewire\DataTable;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AccountingDataTable extends Component
{
    public function render()
    {
        return view('livewire.data-table.accounting-data-table');
    }
}
