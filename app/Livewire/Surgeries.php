<?php

namespace App\Livewire;

use App\Models\Surgery;
use Livewire\Component;

class Surgeries extends Component
{
    public function render()
    {
        $surgeries = Surgery::where('active', true)->orderBy('orden')->get();
        return view('livewire.surgeries', compact('surgeries'));
    }
}
