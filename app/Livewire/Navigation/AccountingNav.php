<?php

namespace App\Livewire\Navigation;


use App\Livewire\Actions\Logout;
use Livewire\Component;

class AccountingNav extends Component
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
        return view('livewire.navigation.accounting-nav');
    }
}
