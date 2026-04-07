<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CitaForm extends Component
{
    public ?string $paciente_nombre = null;
    public ?string $telefono = null;
    public ?string $email = null;
    public ?string $especialidad_id = null;
    public ?string $fecha = null;
    public ?string $hora = null;
    public ?string $notas = null;
    public ?string $successMessage = null;
    public ?string $errorMessage = null;

    public function rules(): array
    {
        return [
            'paciente_nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'notas' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_nombre.required' => 'El nombre del paciente es obligatorio.',
            'telefono.required' => 'El telefono es obligatorio.',
            'especialidad_id.required' => 'Selecciona una especialidad.',
            'especialidad_id.exists' => 'La especialidad seleccionada no es valida.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.after_or_equal' => 'La fecha no puede ser en el pasado.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'Formato de hora invalido.',
            'email.email' => 'Ingresa un correo electronico valido.',
        ];
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field);
    }

    public function reservar(): void
    {
        $this->successMessage = null;
        $this->errorMessage = null;

        Log::info('CitaForm reservar() invoked', [
            'telefono' => $this->telefono,
            'especialidad_id' => $this->especialidad_id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        try {
            $data = $this->validate();

            DB::transaction(function () use ($data): void {
                $paciente = Paciente::firstOrCreate(
                    ['telefono' => (string) $data['telefono']],
                    [
                        'nombre' => (string) $data['paciente_nombre'],
                        'email' => $data['email'] ?? null,
                    ]
                );

                Cita::create([
                    'paciente_id' => $paciente->id,
                    'especialidad_id' => (int) $data['especialidad_id'],
                    'fecha' => (string) $data['fecha'],
                    'hora' => (string) $data['hora'],
                    'estado' => 'pendiente',
                    'notas' => $data['notas'] ?? null,
                ]);

                Log::info('CitaForm cita saved', [
                    'paciente_id' => $paciente->id,
                    'especialidad_id' => (int) $data['especialidad_id'],
                ]);
            });

            $this->successMessage = '¡Cita registrada correctamente! Nos pondremos en contacto contigo pronto.';
            $this->reset(['paciente_nombre', 'telefono', 'email', 'especialidad_id', 'fecha', 'hora', 'notas']);
        } catch (\Throwable $e) {
            Log::error('Error al registrar cita (Class Component)', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            $this->errorMessage = 'No se pudo registrar la cita. Intenta nuevamente en unos segundos.';
        }
    }

    public function render()
    {
        return view('livewire.cita-form', [
            'especialidades' => Especialidad::orderBy('nombre')->get(),
        ]);
    }
}
