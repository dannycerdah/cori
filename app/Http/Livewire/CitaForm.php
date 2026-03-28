<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Paciente;
use Livewire\Component;

class CitaForm extends Component
{
    public $paciente_nombre;
    public $telefono;
    public $email;
    public $especialidad_id;
    public $fecha;
    public $hora;
    public $notas;

    public function rules()
    {
        return [
            'paciente_nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'notas' => 'nullable|string',
        ];
    }

    public function reservar()
    {
        $this->validate();

        $paciente = Paciente::firstOrCreate(
            ['telefono' => $this->telefono],
            ['nombre' => $this->paciente_nombre, 'email' => $this->email]
        );

        Cita::create([
            'paciente_id' => $paciente->id,
            'especialidad_id' => $this->especialidad_id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'notas' => $this->notas,
        ]);

        session()->flash('message', 'Cita registrada correctamente.');

        $this->reset(['paciente_nombre', 'telefono', 'email', 'especialidad_id', 'fecha', 'hora', 'notas']);
    }

    public function render()
    {
        return view('livewire.cita-form', [
            'especialidades' => Especialidad::orderBy('nombre')->get(),
        ]);
    }
}
