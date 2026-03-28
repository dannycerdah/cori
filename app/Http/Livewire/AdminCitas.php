<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;

class AdminCitas extends Component
{
    public $filtroEstado = '';

    public function getCitasProperty()
    {
        $query = Cita::with('paciente', 'especialidad')->orderBy('fecha')->orderBy('hora');

        if ($this->filtroEstado) {
            $query->where('estado', $this->filtroEstado);
        }

        return $query->get();
    }

    public function actualizarEstado(Cita $cita, $estado)
    {
        $cita->update(['estado' => $estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function render()
    {
        return view('livewire.admin-citas', ['citas' => $this->citas]);
    }
}
