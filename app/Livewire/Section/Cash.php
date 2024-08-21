<?php

namespace App\Livewire\Section;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Cash extends Component
{
    public function render()
    {
        return view('livewire.section.cash');
    }
}
