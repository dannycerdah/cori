<?php

namespace App\Livewire\Admin;

use App\Models\Especialidad;
use App\Models\Servicio;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosManager extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $buscar = '';

    public string $filtroEspecialidad = '';

    public bool $mostrarModal = false;

    public ?int $editandoId = null;

    // Campos del formulario
    public ?string $especialidad_id = null;

    public string $nombre = '';

    public ?string $descripcion = null;

    public bool $requiere_doctor = false;

    public bool $estado = true;

    protected function rules(): array
    {
        return [
            'especialidad_id' => ['required', 'exists:especialidades,id'],
            'nombre' => [
                'required', 'string', 'max:150',
                Rule::unique('servicios', 'nombre')
                    ->where(fn ($q) => $q->where('especialidad_id', $this->especialidad_id))
                    ->ignore($this->editandoId),
            ],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'requiere_doctor' => ['boolean'],
            'estado' => ['boolean'],
        ];
    }

    protected function messages(): array
    {
        return [
            'especialidad_id.required' => 'Selecciona una especialidad.',
            'especialidad_id.exists' => 'La especialidad no es válida.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe un servicio con ese nombre en esa especialidad.',
            'nombre.max' => 'El nombre no puede superar los 150 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
        ];
    }

    public function updatingBuscar(): void
    {
        $this->resetPage();
    }

    public function updatingFiltroEspecialidad(): void
    {
        $this->resetPage();
    }

    public function abrirModal(): void
    {
        $this->reset(['editandoId', 'especialidad_id', 'nombre', 'descripcion', 'requiere_doctor']);
        $this->estado = true;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function editar(int $id): void
    {
        $servicio = Servicio::findOrFail($id);
        $this->editandoId = $servicio->id;
        $this->especialidad_id = (string) $servicio->especialidad_id;
        $this->nombre = $servicio->nombre;
        $this->descripcion = $servicio->descripcion;
        $this->requiere_doctor = $servicio->requiere_doctor;
        $this->estado = $servicio->estado;
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

        Servicio::updateOrCreate(['id' => $this->editandoId], $datos);

        session()->flash('message', $this->editandoId ? 'Servicio actualizado.' : 'Servicio creado.');
        $this->mostrarModal = false;
    }

    public function toggleEstado(int $id): void
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->update(['estado' => ! $servicio->estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function eliminar(int $id): void
    {
        $servicio = Servicio::withCount(['horarios', 'citas'])->findOrFail($id);

        if ($servicio->horarios_count > 0 || $servicio->citas_count > 0) {
            session()->flash('error', 'No se puede eliminar: el servicio tiene horarios o citas asociadas. Desactívalo en su lugar.');

            return;
        }

        $servicio->delete();
        session()->flash('message', 'Servicio eliminado.');
    }

    public function render()
    {
        $servicios = Servicio::with('especialidad')
            ->withCount(['horarios', 'citas'])
            ->when($this->buscar, fn ($q) => $q->where('nombre', 'like', "%{$this->buscar}%"))
            ->when($this->filtroEspecialidad, fn ($q) => $q->where('especialidad_id', $this->filtroEspecialidad))
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.admin.servicios-manager', [
            'servicios' => $servicios,
            'especialidades' => Especialidad::orderBy('nombre')->get(),
        ]);
    }
}
