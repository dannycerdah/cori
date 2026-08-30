<?php

namespace App\Livewire;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Paciente;
use App\Models\Servicio;
use App\Support\DisponibilidadCitas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CitaForm extends Component
{
    public ?string $paciente_nombres = null;

    public ?string $paciente_apellidos = null;

    public ?string $tipo_documento = null;

    public ?string $numero_documento = null;

    public ?string $telefono = null;

    public ?string $correo = null;

    public ?Paciente $pacienteEncontrado = null;

    public ?string $especialidad_id = null;

    public ?string $servicio_id = null;

    public ?string $fecha = null;

    public ?string $hora = null;

    public ?string $observacion = null;

    public ?string $successMessage = null;

    public ?string $errorMessage = null;

    /**
     * Paso actual del asistente móvil (1..4). En escritorio se ignora: el
     * formulario se muestra completo en una sola vista.
     */
    public int $pasoActual = 1;

    /**
     * Ventana (en días) que se ofrece para reservar, contada desde hoy.
     */
    public const DIAS_VENTANA = 15;

    /**
     * Cantidad total de pasos del asistente móvil.
     */
    public const TOTAL_PASOS = 4;

    /**
     * Campos que se validan al avanzar cada paso del asistente móvil.
     */
    private const CAMPOS_POR_PASO = [
        1 => ['tipo_documento', 'numero_documento', 'paciente_nombres', 'paciente_apellidos', 'telefono', 'correo'],
        2 => ['especialidad_id', 'servicio_id'],
        3 => ['fecha', 'hora', 'observacion'],
    ];

    /**
     * Memoización de la disponibilidad dentro de un mismo request de Livewire
     * (las vistas de escritorio y móvil incluyen el mismo bloque).
     *
     * @var list<array>|null
     */
    private ?array $cacheFechasDisponibles = null;

    /**
     * @var array<string, list<array>>
     */
    private array $cacheSlotsDisponibles = [];

    private bool $servicioResuelto = false;

    private ?Servicio $servicioCache = null;

    public function rules(): array
    {
        return [
            'paciente_nombres' => 'required|string|max:150',
            'paciente_apellidos' => 'required|string|max:150',
            'tipo_documento' => 'required|in:DNI,CE',
            'numero_documento' => 'required|string|min:8|max:10|unique:pacientes,numero_documento,'.($this->pacienteEncontrado?->id ?? 'NULL').',id',
            'telefono' => 'required|string|max:30',
            'correo' => 'nullable|email|max:150',
            'especialidad_id' => 'required|exists:especialidades,id',
            'servicio_id' => 'required|exists:servicios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'observacion' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_nombres.required' => 'El nombre del paciente es obligatorio.',
            'paciente_apellidos.required' => 'Los apellidos del paciente son obligatorios.',
            'tipo_documento.required' => 'Selecciona el tipo de documento.',
            'tipo_documento.in' => 'Tipo de documento inválido.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.min' => 'El número de documento debe tener al menos 8 caracteres.',
            'numero_documento.max' => 'El número de documento no puede tener más de 10 caracteres.',
            'numero_documento.unique' => 'Este número de documento ya está registrado.',
            'telefono.required' => 'El telefono es obligatorio.',
            'especialidad_id.required' => 'Selecciona una especialidad.',
            'especialidad_id.exists' => 'La especialidad seleccionada no es valida.',
            'servicio_id.required' => 'Selecciona un servicio.',
            'servicio_id.exists' => 'El servicio seleccionado no es valido.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.after_or_equal' => 'La fecha no puede ser en el pasado.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'Formato de hora invalido.',
            'correo.email' => 'Ingresa un correo electronico valido.',
        ];
    }

    public function updated(string $field): void
    {
        if (in_array($field, ['tipo_documento', 'numero_documento'])) {
            $this->buscarPaciente();
        }

        // Si cambia la especialidad, el servicio y la disponibilidad elegida dejan de ser válidos.
        if ($field === 'especialidad_id') {
            $this->servicio_id = null;
            $this->fecha = null;
            $this->hora = null;
        }

        // Si cambia el servicio, cambia la disponibilidad.
        if ($field === 'servicio_id') {
            $this->fecha = null;
            $this->hora = null;
        }

        $this->validateOnly($field);
    }

    /**
     * Servicio elegido, solo si pertenece a la especialidad elegida y está activo.
     */
    public function getServicioSeleccionadoProperty(): ?Servicio
    {
        if ($this->servicioResuelto) {
            return $this->servicioCache;
        }

        $this->servicioResuelto = true;

        if (! $this->especialidad_id || ! $this->servicio_id) {
            return $this->servicioCache = null;
        }

        return $this->servicioCache = Servicio::where('id', $this->servicio_id)
            ->where('especialidad_id', $this->especialidad_id)
            ->where('estado', true)
            ->first();
    }

    /**
     * Fechas con cupo para el servicio elegido (para el selector de fecha).
     *
     * @return list<array{fecha: string, etiqueta: string, cupos: int}>
     */
    public function getFechasDisponiblesProperty(): array
    {
        if ($this->cacheFechasDisponibles !== null) {
            return $this->cacheFechasDisponibles;
        }

        $servicio = $this->servicioSeleccionado;

        return $this->cacheFechasDisponibles = $servicio
            ? (new DisponibilidadCitas(self::DIAS_VENTANA))->fechasDisponibles($servicio)
            : [];
    }

    /**
     * Franjas horarias libres para el servicio y la fecha elegidos.
     *
     * @return list<array{hora_inicio: string, hora_fin: string, horario_id: int, doctor_id: int|null, capacidad: int, cupos: int}>
     */
    public function getSlotsDisponiblesProperty(): array
    {
        $servicio = $this->servicioSeleccionado;

        if (! $servicio || ! $this->fecha) {
            return [];
        }

        return $this->cacheSlotsDisponibles[$this->fecha] ??=
            (new DisponibilidadCitas(self::DIAS_VENTANA))->slotsDisponibles($servicio, $this->fecha);
    }

    /**
     * Selecciona una fecha del calendario de disponibilidad.
     */
    public function elegirFecha(string $fecha): void
    {
        $this->fecha = $fecha;
        $this->hora = null;
        $this->resetValidation(['fecha', 'hora']);
    }

    /**
     * Selecciona una franja horaria disponible.
     */
    public function elegirHora(string $hora): void
    {
        $this->hora = $hora;
        $this->resetValidation('hora');
    }

    /**
     * Avanza al siguiente paso del asistente móvil, validando solo los campos
     * del paso actual.
     */
    public function siguientePaso(): void
    {
        $reglas = collect($this->rules())
            ->only(self::CAMPOS_POR_PASO[$this->pasoActual] ?? [])
            ->all();

        if ($reglas) {
            $this->validate($reglas);
        }

        $this->pasoActual = min($this->pasoActual + 1, self::TOTAL_PASOS);
    }

    /**
     * Retrocede un paso en el asistente móvil.
     */
    public function pasoAnterior(): void
    {
        $this->pasoActual = max($this->pasoActual - 1, 1);
    }

    /**
     * Salta a un paso concreto (solo hacia atrás, para no saltarse validaciones).
     */
    public function irAPaso(int $paso): void
    {
        if ($paso >= 1 && $paso < $this->pasoActual) {
            $this->pasoActual = $paso;
        }
    }

    /**
     * Servicios activos de la especialidad seleccionada (para el select dependiente).
     */
    public function getServiciosProperty()
    {
        if (! $this->especialidad_id) {
            return collect();
        }

        return Servicio::where('especialidad_id', $this->especialidad_id)
            ->where('estado', true)
            ->orderBy('nombre')
            ->get();
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
                $this->paciente_nombres = $this->pacienteEncontrado->nombres;
                $this->paciente_apellidos = $this->pacienteEncontrado->apellidos;
                $this->telefono = $this->pacienteEncontrado->telefono;
                $this->correo = $this->pacienteEncontrado->correo;

                return;
            }
        }

        $this->pacienteEncontrado = null;
        $this->paciente_nombres = null;
        $this->paciente_apellidos = null;
        $this->telefono = null;
        $this->correo = null;
    }

    /**
     * ¿El paciente ya tiene una cita activa (no cancelada / no "no asistió")
     * para el mismo servicio en esa fecha?
     */
    private function pacienteYaTieneCita(int $pacienteId, Servicio $servicio, string $fecha): bool
    {
        return Cita::query()
            ->where('paciente_id', $pacienteId)
            ->where('especialidad_id', $servicio->especialidad_id)
            ->where('servicio_id', $servicio->id)
            ->whereDate('fecha', $fecha)
            ->whereNotIn('estado', ['CANCELADA', 'NO_ASISTIO'])
            ->exists();
    }

    public function reservar(): void
    {
        $this->successMessage = null;
        $this->errorMessage = null;

        $throttleKey = 'cita-reservar:'.request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $segundos = RateLimiter::availableIn($throttleKey);
            $this->errorMessage = 'Demasiados intentos. Por favor espera '.ceil($segundos / 60).' minuto(s) antes de volver a intentarlo.';

            return;
        }

        Log::info('CitaForm reservar() invoked', [
            'telefono' => $this->telefono,
            'especialidad_id' => $this->especialidad_id,
            'servicio_id' => $this->servicio_id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        try {
            $data = $this->validate();

            // El servicio debe pertenecer a la especialidad seleccionada.
            $servicio = Servicio::where('id', $data['servicio_id'])
                ->where('especialidad_id', $data['especialidad_id'])
                ->first();

            if (! $servicio) {
                $this->addError('servicio_id', 'El servicio no corresponde a la especialidad elegida.');

                return;
            }

            // La franja elegida debe seguir teniendo cupo (revalida contra los
            // horarios y las citas ya registradas).
            $disponibilidad = new DisponibilidadCitas(self::DIAS_VENTANA);
            $slot = $disponibilidad->slotSigueDisponible($servicio, $data['fecha'], $data['hora']);

            if ($slot === null) {
                $this->hora = null;
                $this->addError('hora', 'Ese horario ya no está disponible. Elige otra hora.');

                return;
            }

            // Una misma persona no puede tener dos citas activas para el mismo
            // servicio el mismo día.
            if ($this->pacienteEncontrado && $this->pacienteYaTieneCita($this->pacienteEncontrado->id, $servicio, $data['fecha'])) {
                $this->addError('fecha', 'Ya tienes una cita registrada para este servicio en esa fecha.');

                return;
            }

            RateLimiter::hit($throttleKey, 600);

            $horaInicio = $slot['hora_inicio'];
            $horaFin = $slot['hora_fin'];

            DB::transaction(function () use ($data, $servicio, $slot, $horaInicio, $horaFin): void {
                // Recuento bajo bloqueo para evitar sobreventa por reservas simultáneas.
                $ocupados = Cita::query()
                    ->where('servicio_id', $servicio->id)
                    ->whereDate('fecha', $data['fecha'])
                    ->where('hora_inicio', $horaInicio)
                    ->whereIn('estado', ['REGISTRADA', 'CONFIRMADA', 'ATENDIDA'])
                    ->lockForUpdate()
                    ->count();

                if ($ocupados >= $slot['capacidad']) {
                    throw ValidationException::withMessages([
                        'hora' => 'Ese horario acaba de llenarse. Elige otra hora.',
                    ]);
                }

                $atributosPaciente = [
                    'nombres' => (string) $data['paciente_nombres'],
                    'apellidos' => (string) $data['paciente_apellidos'],
                    'tipo_documento' => $data['tipo_documento'],
                    'numero_documento' => $data['numero_documento'],
                    'telefono' => (string) $data['telefono'],
                    'correo' => $data['correo'] ?? null,
                ];

                if ($this->pacienteEncontrado) {
                    $this->pacienteEncontrado->update($atributosPaciente);
                    $paciente = $this->pacienteEncontrado;
                } else {
                    $paciente = Paciente::create($atributosPaciente);
                }

                // Re-verifica con el paciente ya resuelto (cubre pacientes nuevos
                // y envíos simultáneos).
                if ($this->pacienteYaTieneCita($paciente->id, $servicio, $data['fecha'])) {
                    throw ValidationException::withMessages([
                        'fecha' => 'Ya tienes una cita registrada para este servicio en esa fecha.',
                    ]);
                }

                Cita::create([
                    'paciente_id' => $paciente->id,
                    'especialidad_id' => (int) $data['especialidad_id'],
                    'servicio_id' => $servicio->id,
                    'doctor_id' => $slot['doctor_id'],
                    'horario_id' => $slot['horario_id'],
                    'fecha' => (string) $data['fecha'],
                    'hora_inicio' => $horaInicio,
                    'hora_fin' => $horaFin,
                    'tipo' => 'NORMAL',
                    'estado' => 'REGISTRADA',
                    'observacion' => $data['observacion'] ?? null,
                ]);

                Log::info('CitaForm cita saved', [
                    'paciente_id' => $paciente->id,
                    'servicio_id' => $servicio->id,
                ]);
            });

            $this->successMessage = '¡Cita registrada correctamente! Nos pondremos en contacto contigo pronto.';
            $this->reset(['paciente_nombres', 'paciente_apellidos', 'tipo_documento', 'numero_documento', 'telefono', 'correo', 'especialidad_id', 'servicio_id', 'fecha', 'hora', 'observacion']);
            $this->pacienteEncontrado = null;
            $this->pasoActual = 1;
        } catch (ValidationException $e) {
            throw $e;
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
        return view('components.citas', [
            'especialidades' => Especialidad::where('estado', true)->orderBy('nombre')->get(),
            'servicios' => $this->servicios,
            'totalPasos' => self::TOTAL_PASOS,
        ]);
    }
}
