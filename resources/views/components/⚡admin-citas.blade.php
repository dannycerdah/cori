<?php

use App\Models\Cita;
use Livewire\Component;

new class extends Component
{
    public $filtroEstado = '';
    public $citas = [];

    public function mount()
    {
        $this->citas = Cita::with('paciente', 'especialidad')->orderBy('fecha')->orderBy('hora')->get();
    }

    public function actualizarEstado($citaId, $estado)
    {
        $cita = Cita::findOrFail($citaId);
        $cita->estado = $estado;
        $cita->save();

        $this->citas = Cita::with('paciente', 'especialidad')->orderBy('fecha')->orderBy('hora')->get();
        session()->flash('message', 'Estado actualizado.');
    }

};
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Panel de citas</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <label class="text-sm font-medium">Filtrar por estado</label>
        <select wire:model="filtroEstado" class="mt-1 block w-56 border rounded p-2">
            <option value="">Todos</option>
            <option value="pendiente">Pendiente</option>
            <option value="atendido">Atendido</option>
            <option value="cancelado">Cancelado</option>
        </select>
    </div>

    <table class="min-w-full border-collapse">
        <thead>
            <tr>
                <th class="border p-2">Fecha</th>
                <th class="border p-2">Hora</th>
                <th class="border p-2">Paciente</th>
                <th class="border p-2">Teléfono</th>
                <th class="border p-2">Especialidad</th>
                <th class="border p-2">Estado</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filtroEstado ? $citas->where('estado', $filtroEstado) : $citas as $cita)
                <tr>
                    <td class="border p-2">{{ $cita->fecha }}</td>
                    <td class="border p-2">{{ $cita->hora }}</td>
                    <td class="border p-2">{{ $cita->paciente->nombre }}</td>
                    <td class="border p-2">{{ $cita->paciente->telefono }}</td>
                    <td class="border p-2">{{ $cita->especialidad->nombre }}</td>
                    <td class="border p-2">{{ ucfirst($cita->estado) }}</td>
                    <td class="border p-2 space-x-1">
                        <button wire:click="actualizarEstado({{ $cita->id }}, 'pendiente')" class="px-2 py-1 bg-blue-500 text-white rounded">Pendiente</button>
                        <button wire:click="actualizarEstado({{ $cita->id }}, 'atendido')" class="px-2 py-1 bg-green-500 text-white rounded">Atendido</button>
                        <button wire:click="actualizarEstado({{ $cita->id }}, 'cancelado')" class="px-2 py-1 bg-red-500 text-white rounded">Cancelado</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>