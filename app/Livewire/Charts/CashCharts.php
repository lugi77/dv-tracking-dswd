<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Accounting;
use App\Models\Cash;

class CashCharts extends Component
{
    public function render()
    {
        return view('livewire.charts.cash-charts');
    }
}
