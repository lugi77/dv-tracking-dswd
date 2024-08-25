<?php

namespace App\Livewire\Navigation;

use App\Livewire\Actions\Logout;

use Livewire\Component;

class ProfileLogout extends Component
{
    public function render()
    {
        return view('livewire.navigation.profile-logout');
    }
}
