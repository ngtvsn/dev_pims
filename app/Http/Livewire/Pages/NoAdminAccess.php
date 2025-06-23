<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class NoAdminAccess extends Component
{
    public function render()
    {
        return view('livewire.pages.no-admin-access');
    }
}
