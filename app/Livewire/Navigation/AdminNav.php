<?php

namespace App\Livewire\Navigation;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class AdminNav extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.navigation.admin-nav');
    }
}
