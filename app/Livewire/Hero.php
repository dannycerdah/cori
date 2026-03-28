<?php

namespace App\Livewire;

use App\Models\Hero as HeroModel;
use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        $hero = HeroModel::where('active', true)->first();
        return view('livewire.hero', compact('hero'));
    }
}
