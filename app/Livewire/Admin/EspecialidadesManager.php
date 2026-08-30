<?php

namespace App\Livewire\Admin;

use App\Models\Especialidad;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadesManager extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $buscar = '';

    public bool $mostrarModal = false;

    public ?int $editandoId = null;

    // Campos del formulario
    public string $nombre = '';

    public ?string $descripcion = null;

    public bool $estado = true;

    protected function rules(): array
    {
        return [
            'nombre' => [
                'required', 'string', 'max:150',
                Rule::unique('especialidades', 'nombre')->ignore($this->editandoId),
            ],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'estado' => ['boolean'],
        ];
    }

    protected function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe una especialidad con ese nombre.',
            'nombre.max' => 'El nombre no puede superar los 150 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
        ];
    }

    public function updatingBuscar(): void
    {
        $this->resetPage();
    }

    public function abrirModal(): void
    {
        $this->reset(['editandoId', 'nombre', 'descripcion']);
        $this->estado = true;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function editar(int $id): void
    {
        $especialidad = Especialidad::findOrFail($id);
        $this->editandoId = $especialidad->id;
        $this->nombre = $especialidad->nombre;
        $this->descripcion = $especialidad->descripcion;
        $this->estado = $especialidad->estado;
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

        Especialidad::updateOrCreate(['id' => $this->editandoId], $datos);

        session()->flash('message', $this->editandoId ? 'Especialidad actualizada.' : 'Especialidad creada.');
        $this->mostrarModal = false;
    }

    public function toggleEstado(int $id): void
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->update(['estado' => ! $especialidad->estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function eliminar(int $id): void
    {
        $especialidad = Especialidad::withCount(['servicios', 'citas'])->findOrFail($id);

        if ($especialidad->servicios_count > 0 || $especialidad->citas_count > 0) {
            session()->flash('error', 'No se puede eliminar: la especialidad tiene servicios o citas asociadas. Desactívala en su lugar.');

            return;
        }

        $especialidad->doctores()->detach();
        $especialidad->delete();
        session()->flash('message', 'Especialidad eliminada.');
    }

    public function render()
    {
        $especialidades = Especialidad::withCount(['servicios', 'citas'])
            ->when($this->buscar, fn ($q) => $q->where('nombre', 'like', "%{$this->buscar}%"))
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.admin.especialidades-manager', compact('especialidades'));
    }
}
