<?php

namespace App\Livewire\Admin;

use App\Models\BloqueoHorario;
use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class BloqueosManager extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $filtroDoctor = '';

    public string $filtroFecha = '';

    public bool $mostrarModal = false;

    public ?int $editandoId = null;

    // Campos del formulario
    public ?string $doctor_id = null;

    public ?string $fecha = null;

    public ?string $hora_inicio = null;

    public ?string $hora_fin = null;

    public ?string $motivo = null;

    public bool $estado = true;

    protected function rules(): array
    {
        return [
            'doctor_id' => ['required', 'exists:doctores,id'],
            'fecha' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'motivo' => ['nullable', 'string', 'max:500'],
            'estado' => ['boolean'],
        ];
    }

    protected function messages(): array
    {
        return [
            'doctor_id.required' => 'Selecciona un doctor.',
            'fecha.required' => 'La fecha es obligatoria.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'Formato de hora inválido.',
            'hora_fin.required' => 'La hora de fin es obligatoria.',
            'hora_fin.date_format' => 'Formato de hora inválido.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'motivo.max' => 'El motivo no puede superar los 500 caracteres.',
        ];
    }

    public function updatingFiltroDoctor(): void
    {
        $this->resetPage();
    }

    public function updatingFiltroFecha(): void
    {
        $this->resetPage();
    }

    public function abrirModal(): void
    {
        $this->reset(['editandoId', 'doctor_id', 'fecha', 'hora_inicio', 'hora_fin', 'motivo']);
        $this->estado = true;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function editar(int $id): void
    {
        $bloqueo = BloqueoHorario::findOrFail($id);
        $this->editandoId = $bloqueo->id;
        $this->doctor_id = (string) $bloqueo->doctor_id;
        $this->fecha = $bloqueo->fecha->toDateString();
        $this->hora_inicio = substr($bloqueo->hora_inicio, 0, 5);
        $this->hora_fin = substr($bloqueo->hora_fin, 0, 5);
        $this->motivo = $bloqueo->motivo;
        $this->estado = $bloqueo->estado;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function cerrarModal(): void
    {
        $this->mostrarModal = false;
    }

    public function guardar(): void
    {
        $datos = $this->validate();

        BloqueoHorario::updateOrCreate(['id' => $this->editandoId], $datos);

        session()->flash('message', $this->editandoId ? 'Bloqueo actualizado.' : 'Bloqueo creado.');
        $this->mostrarModal = false;
    }

    public function toggleEstado(int $id): void
    {
        $bloqueo = BloqueoHorario::findOrFail($id);
        $bloqueo->update(['estado' => ! $bloqueo->estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function eliminar(int $id): void
    {
        BloqueoHorario::findOrFail($id)->delete();
        session()->flash('message', 'Bloqueo eliminado.');
    }

    public function render()
    {
        $bloqueos = BloqueoHorario::with('doctor')
            ->when($this->filtroDoctor, fn ($q) => $q->where('doctor_id', $this->filtroDoctor))
            ->when($this->filtroFecha, fn ($q) => $q->whereDate('fecha', $this->filtroFecha))
            ->orderByDesc('fecha')
            ->orderBy('hora_inicio')
            ->paginate(10);

        return view('livewire.admin.bloqueos-manager', [
            'bloqueos' => $bloqueos,
            'doctores' => Doctor::orderBy('apellidos')->orderBy('nombres')->get(),
        ]);
    }
}
