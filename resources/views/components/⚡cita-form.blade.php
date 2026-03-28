<?php

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Paciente;
use Livewire\Component;

new class extends Component
{
    public $paciente_nombre;
    public $telefono;
    public $email;
    public $especialidad_id;
    public $fecha;
    public $hora;
    public $notas;

    public $especialidades;

    protected $rules = [
        'paciente_nombre' => 'required|string|max:255',
        'telefono' => 'required|string|max:30',
        'email' => 'nullable|email|max:255',
        'especialidad_id' => 'required|exists:especialidades,id',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',
        'notas' => 'nullable|string',
    ];

    public function mount()
    {
        $this->especialidades = Especialidad::orderBy('nombre')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

};
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Registrar cita médica</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="reservar">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Nombre del paciente</label>
                <input type="text" wire:model="paciente_nombre" class="mt-1 block w-full border rounded p-2" />
                @error('paciente_nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Teléfono</label>
                <input type="text" wire:model="telefono" class="mt-1 block w-full border rounded p-2" />
                @error('telefono') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email (opcional)</label>
                <input type="email" wire:model="email" class="mt-1 block w-full border rounded p-2" />
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Especialidad</label>
                <select wire:model="especialidad_id" class="mt-1 block w-full border rounded p-2">
                    <option value="">Seleccione una especialidad</option>
                    @foreach($this->especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
                @error('especialidad_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Fecha</label>
                <input type="date" wire:model="fecha" class="mt-1 block w-full border rounded p-2" />
                @error('fecha') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Hora</label>
                <input type="time" wire:model="hora" class="mt-1 block w-full border rounded p-2" />
                @error('hora') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium">Notas</label>
                <textarea wire:model="notas" class="mt-1 block w-full border rounded p-2" rows="3"></textarea>
                @error('notas') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">Registrar cita</button>
    </form>
</div>
