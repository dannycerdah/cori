<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class DoctoresManager extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $buscar = '';

    public bool $mostrarModal = false;

    public ?int $editandoId = null;

    // Campos del formulario
    public string $nombres = '';

    public string $apellidos = '';

    public ?string $tipo_documento = null;

    public ?string $numero_documento = null;

    public ?string $telefono = null;

    public ?string $correo = null;

    public bool $estado = true;

    /** @var array<int> */
    public array $especialidades = [];

    protected function rules(): array
    {
        return [
            'nombres' => ['required', 'string', 'max:150'],
            'apellidos' => ['required', 'string', 'max:150'],
            'tipo_documento' => ['nullable', 'string', 'max:20'],
            'numero_documento' => [
                'nullable', 'string', 'max:30',
                Rule::unique('doctores', 'numero_documento')->ignore($this->editandoId),
            ],
            'telefono' => ['nullable', 'string', 'max:30'],
            'correo' => ['nullable', 'email', 'max:150'],
            'estado' => ['boolean'],
            'especialidades' => ['array'],
            'especialidades.*' => ['exists:especialidades,id'],
        ];
    }

    protected function messages(): array
    {
        return [
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'numero_documento.unique' => 'Ya existe un doctor con ese número de documento.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
        ];
    }

    public function updatingBuscar(): void
    {
        $this->resetPage();
    }

    public function abrirModal(): void
    {
        $this->reset(['editandoId', 'nombres', 'apellidos', 'tipo_documento', 'numero_documento', 'telefono', 'correo', 'especialidades']);
        $this->estado = true;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function editar(int $id): void
    {
        $doctor = Doctor::with('especialidades')->findOrFail($id);
        $this->editandoId = $doctor->id;
        $this->nombres = $doctor->nombres;
        $this->apellidos = $doctor->apellidos;
        $this->tipo_documento = $doctor->tipo_documento;
        $this->numero_documento = $doctor->numero_documento;
        $this->telefono = $doctor->telefono;
        $this->correo = $doctor->correo;
        $this->estado = $doctor->estado;
        $this->especialidades = $doctor->especialidades->pluck('id')->all();
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
        $especialidades = $datos['especialidades'] ?? [];
        unset($datos['especialidades']);

        $doctor = Doctor::updateOrCreate(['id' => $this->editandoId], $datos);

        $doctor->especialidades()->sync(
            collect($especialidades)->mapWithKeys(fn ($id) => [$id => ['estado' => true]])->all()
        );

        session()->flash('message', $this->editandoId ? 'Doctor actualizado.' : 'Doctor creado.');
        $this->mostrarModal = false;
    }

    public function toggleEstado(int $id): void
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['estado' => ! $doctor->estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function eliminar(int $id): void
    {
        $doctor = Doctor::withCount(['horarios', 'bloqueos', 'citas'])->findOrFail($id);

        if ($doctor->horarios_count > 0 || $doctor->bloqueos_count > 0 || $doctor->citas_count > 0) {
            session()->flash('error', 'No se puede eliminar: el doctor tiene horarios, bloqueos o citas asociadas. Desactívalo en su lugar.');

            return;
        }

        $doctor->especialidades()->detach();
        $doctor->delete();
        session()->flash('message', 'Doctor eliminado.');
    }

    public function render()
    {
        $doctores = Doctor::with('especialidades')
            ->when($this->buscar, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('nombres', 'like', "%{$this->buscar}%")
                        ->orWhere('apellidos', 'like', "%{$this->buscar}%")
                        ->orWhere('numero_documento', 'like', "%{$this->buscar}%");
                });
            })
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->paginate(10);

        return view('livewire.admin.doctores-manager', [
            'doctores' => $doctores,
            'listaEspecialidades' => Especialidad::orderBy('nombre')->get(),
        ]);
    }
}
