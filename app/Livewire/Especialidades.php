<?php

namespace App\Livewire;

use App\Models\Especialidad;
use Livewire\Component;

class Especialidades extends Component
{
    public function render()
    {
        $especialidades = Especialidad::all();
        return view('livewire.especialidades', ['especialidades' => $especialidades]);
    }
}
