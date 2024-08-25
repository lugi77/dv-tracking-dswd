<?php

namespace App\Livewire\Navigation;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class BudgetNav extends Component
{

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
    public function render()
    {
        return view('livewire.navigation.budget-nav');
    }
}
