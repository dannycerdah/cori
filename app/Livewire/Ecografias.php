<?php

namespace App\Livewire;

use App\Models\Ecografia;
use Livewire\Component;

class Ecografias extends Component
{
    public function render()
    {
        $ecografias = Ecografia::where('active', true)->orderBy('orden')->get();
        return view('livewire.ecografias', compact('ecografias'));
    }
}
