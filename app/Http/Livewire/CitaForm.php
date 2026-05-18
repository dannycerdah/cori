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
    public ?string $tipo_documento = null;
    public ?string $numero_documento = null;
    public ?string $telefono = null;
    public ?string $email = null;
    public ?Paciente $pacienteEncontrado = null;
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
            'tipo_documento' => 'required|in:DNI,CE',
            'numero_documento' => 'required|string|min:8|max:10|unique:pacientes,numero_documento,' . ($this->pacienteEncontrado?->id ?? 'NULL') . ',id',
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
            'tipo_documento.required' => 'Selecciona el tipo de documento.',
            'tipo_documento.in' => 'Tipo de documento inválido.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.min' => 'El número de documento debe tener al menos 8 caracteres.',
            'numero_documento.max' => 'El número de documento no puede tener más de 10 caracteres.',
            'numero_documento.unique' => 'Este número de documento ya está registrado.',
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
        if (in_array($field, ['tipo_documento', 'numero_documento'])) {
            $this->buscarPaciente();
        }

        $this->validateOnly($field);
    }

    public function buscarPaciente(): void
    {
        $tipo = trim((string) $this->tipo_documento);
        $numero = trim((string) $this->numero_documento);

        if ($tipo !== '' && $numero !== '' && strlen($numero) >= 8 && strlen($numero) <= 10) {
            $this->pacienteEncontrado = Paciente::where('tipo_documento', $tipo)
                ->where('numero_documento', $numero)
                ->first();

            if ($this->pacienteEncontrado) {
                $this->paciente_nombre = $this->pacienteEncontrado->nombre;
                $this->telefono = $this->pacienteEncontrado->telefono;
                $this->email = $this->pacienteEncontrado->email;
                return;
            }
        }

        $this->pacienteEncontrado = null;
        $this->paciente_nombre = null;
        $this->telefono = null;
        $this->email = null;
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
                $paciente = null;

                // Si se encontró un paciente existente, actualizarlo
                if ($this->pacienteEncontrado) {
                    $this->pacienteEncontrado->update([
                        'nombre' => (string) $data['paciente_nombre'],
                        'tipo_documento' => $data['tipo_documento'],
                        'numero_documento' => $data['numero_documento'],
                        'telefono' => (string) $data['telefono'],
                        'email' => $data['email'] ?? null,
                    ]);
                    $paciente = $this->pacienteEncontrado;
                } else {
                    // Crear nuevo paciente
                    $paciente = Paciente::create([
                        'nombre' => (string) $data['paciente_nombre'],
                        'tipo_documento' => $data['tipo_documento'],
                        'numero_documento' => $data['numero_documento'],
                        'telefono' => (string) $data['telefono'],
                        'email' => $data['email'] ?? null,
                    ]);
                }

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
            $this->reset(['paciente_nombre', 'tipo_documento', 'numero_documento', 'telefono', 'email', 'especialidad_id', 'fecha', 'hora', 'notas']);
            $this->pacienteEncontrado = null;
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
