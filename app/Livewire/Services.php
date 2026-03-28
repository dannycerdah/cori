<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $services = Service::where('active', true)->orderBy('orden')->get();
        return view('livewire.services', compact('services'));
    }
}
