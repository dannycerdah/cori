<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Servicio;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class HorariosManager extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    /**
     * Días de la semana (ISO-8601: 1 = lunes ... 7 = domingo).
     */
    public const DIAS = [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
    ];

    public string $filtroServicio = '';

    public bool $mostrarModal = false;

    public ?int $editandoId = null;

    // Campos del formulario
    public ?string $servicio_id = null;

    public ?string $doctor_id = null;

    public ?string $fecha_inicio = null;

    public ?string $fecha_fin = null;

    public ?string $hora_inicio = null;

    public ?string $hora_fin = null;

    public ?string $frecuencia_minutos = '30';

    public ?string $capacidad = '1';

    public bool $estado = true;

    /** @var array<int> */
    public array $dias_semana = [];

    protected function rules(): array
    {
        return [
            'servicio_id' => ['required', 'exists:servicios,id'],
            'doctor_id' => ['nullable', 'exists:doctores,id'],
            'fecha_inicio' => ['nullable', 'date', 'required_with:fecha_fin'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'frecuencia_minutos' => ['required', 'integer', 'min:1', 'max:480'],
            'capacidad' => ['required', 'integer', 'min:1', 'max:100'],
            'estado' => ['boolean'],
            'dias_semana' => ['required', 'array', 'min:1'],
            'dias_semana.*' => ['integer', 'between:1,7'],
        ];
    }

    protected function messages(): array
    {
        return [
            'servicio_id.required' => 'Selecciona un servicio.',
            'fecha_inicio.required_with' => 'Indica la fecha de inicio de la vigencia.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'Formato de hora inválido.',
            'hora_fin.required' => 'La hora de fin es obligatoria.',
            'hora_fin.date_format' => 'Formato de hora inválido.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'frecuencia_minutos.required' => 'La frecuencia es obligatoria.',
            'frecuencia_minutos.min' => 'La frecuencia debe ser de al menos 1 minuto.',
            'capacidad.required' => 'La capacidad es obligatoria.',
            'capacidad.min' => 'La capacidad debe ser de al menos 1.',
            'dias_semana.required' => 'Selecciona al menos un día de la semana.',
            'dias_semana.min' => 'Selecciona al menos un día de la semana.',
        ];
    }

    public function updatingFiltroServicio(): void
    {
        $this->resetPage();
    }

    public function abrirModal(): void
    {
        $this->reset(['editandoId', 'servicio_id', 'doctor_id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'dias_semana']);
        $this->frecuencia_minutos = '30';
        $this->capacidad = '1';
        $this->estado = true;
        $this->resetErrorBag();
        $this->mostrarModal = true;
    }

    public function editar(int $id): void
    {
        $horario = Horario::with('dias')->findOrFail($id);
        $this->editandoId = $horario->id;
        $this->servicio_id = (string) $horario->servicio_id;
        $this->doctor_id = $horario->doctor_id ? (string) $horario->doctor_id : null;
        $this->fecha_inicio = $horario->fecha_inicio?->toDateString();
        $this->fecha_fin = $horario->fecha_fin?->toDateString();
        $this->hora_inicio = substr($horario->hora_inicio, 0, 5);
        $this->hora_fin = substr($horario->hora_fin, 0, 5);
        $this->frecuencia_minutos = (string) $horario->frecuencia_minutos;
        $this->capacidad = (string) $horario->capacidad;
        $this->estado = $horario->estado;
        $this->dias_semana = $horario->dias->pluck('dia_semana')->all();
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

        // Normaliza los campos opcionales: '' desde un <select>/<input> vacío → null.
        $datos['doctor_id'] = $datos['doctor_id'] ?: null;
        $datos['fecha_inicio'] = $datos['fecha_inicio'] ?: null;
        $datos['fecha_fin'] = $datos['fecha_fin'] ?: null;

        // El doctor es obligatorio si el servicio lo requiere.
        $servicio = Servicio::findOrFail($datos['servicio_id']);

        if ($servicio->requiere_doctor && empty($datos['doctor_id'])) {
            throw ValidationException::withMessages([
                'doctor_id' => 'Este servicio requiere un doctor asignado.',
            ]);
        }

        $dias = $datos['dias_semana'];
        unset($datos['dias_semana']);

        $horario = Horario::updateOrCreate(['id' => $this->editandoId], $datos);

        $horario->dias()->delete();
        foreach (array_unique($dias) as $dia) {
            $horario->dias()->create(['dia_semana' => $dia]);
        }

        session()->flash('message', $this->editandoId ? 'Horario actualizado.' : 'Horario creado.');
        $this->mostrarModal = false;
    }

    public function toggleEstado(int $id): void
    {
        $horario = Horario::findOrFail($id);
        $horario->update(['estado' => ! $horario->estado]);
        session()->flash('message', 'Estado actualizado.');
    }

    public function eliminar(int $id): void
    {
        $horario = Horario::findOrFail($id);
        // Las citas guardan horario_id como nullable; al eliminar el horario la
        // referencia queda en null (no se pierden citas). Los días se borran en cascada.
        $horario->delete();
        session()->flash('message', 'Horario eliminado.');
    }

    public function render()
    {
        $horarios = Horario::with(['servicio.especialidad', 'doctor', 'dias'])
            ->when($this->filtroServicio, fn ($q) => $q->where('servicio_id', $this->filtroServicio))
            ->orderBy('servicio_id')
            ->orderBy('hora_inicio')
            ->paginate(10);

        return view('livewire.admin.horarios-manager', [
            'horarios' => $horarios,
            'servicios' => Servicio::with('especialidad')->orderBy('nombre')->get(),
            'doctores' => Doctor::orderBy('apellidos')->orderBy('nombres')->get(),
            'dias' => self::DIAS,
        ]);
    }
}
