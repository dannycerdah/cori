<?php

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Paciente;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public ?string $paciente_nombre = null;
    public ?string $telefono        = null;
    public ?string $email           = null;
    public ?string $especialidad_id = null;
    public ?string $fecha           = null;
    public ?string $hora            = null;
    public ?string $notas           = null;

    public $especialidades = [];

    public function mount(): void
    {
        $this->especialidades = Especialidad::orderBy('nombre')->get();
    }

    protected function rules(): array
    {
        return [
            'paciente_nombre' => 'required|string|max:255',
            'telefono'        => 'required|string|max:30',
            'email'           => 'nullable|email|max:255',
            'especialidad_id' => 'required|exists:especialidades,id',
            'fecha'           => 'required|date|after_or_equal:today',
            'hora'            => 'required|date_format:H:i',
            'notas'           => 'nullable|string|max:1000',
        ];
    }

    protected function messages(): array
    {
        return [
            'paciente_nombre.required' => 'El nombre del paciente es obligatorio.',
            'telefono.required'        => 'El teléfono es obligatorio.',
            'especialidad_id.required' => 'Selecciona una especialidad.',
            'especialidad_id.exists'   => 'La especialidad seleccionada no es válida.',
            'fecha.required'           => 'La fecha es obligatoria.',
            'fecha.date'               => 'Ingresa una fecha válida.',
            'fecha.after_or_equal'     => 'La fecha no puede ser en el pasado.',
            'hora.required'            => 'La hora es obligatoria.',
            'hora.date_format'         => 'Formato de hora inválido.',
            'email.email'              => 'Ingresa un correo electrónico válido.',
        ];
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field);
    }

    public function reservar(): void
    {
        try {
            $data = $this->validate();

            DB::transaction(function () use ($data) {
                $paciente = Paciente::firstOrCreate(
                    ['telefono' => (string) $data['telefono']],
                    [
                        'nombre' => (string) $data['paciente_nombre'],
                        'email'  => $data['email'] ?? null,
                    ]
                );

                Cita::create([
                    'paciente_id'     => $paciente->id,
                    'especialidad_id' => (int) $data['especialidad_id'],
                    'fecha'           => (string) $data['fecha'],
                    'hora'            => (string) $data['hora'],
                    'estado'          => 'pendiente',
                    'notas'           => $data['notas'] ?? null,
                ]);
            });

            $this->reset(['paciente_nombre', 'telefono', 'email', 'especialidad_id', 'fecha', 'hora', 'notas']);
            session()->flash('message', '¡Cita registrada correctamente! Nos pondremos en contacto contigo pronto.');
        } catch (\Throwable $e) {
            Log::error('Error al registrar cita', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            session()->flash('error', 'No se pudo registrar la cita. Intenta nuevamente en unos segundos.');
        }
    }

};
?>

<div class="cori-panel rounded-[1.75rem] p-6 md:p-8">

    {{-- Header --}}
    <div class="mb-7">
        <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
            <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Formulario de reserva</span>
        </div>
        <h2 class="mt-4 text-2xl font-bold text-brand-blue dark:text-white">Agenda tu visita médica</h2>
        <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">Completa los campos y confirmaremos tu cita en breve</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 dark:border-emerald-500/25 dark:bg-emerald-500/10 dark:text-emerald-300">
            <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-700 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-300">
            <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10A8 8 0 114.293 4.293a8 8 0 0113.414 0A7.96 7.96 0 0118 10zm-8-4a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1zm0 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="reservar" class="space-y-5">
        <div class="grid gap-5 md:grid-cols-2">

            {{-- Nombre --}}
            <div>
                <label class="cori-label" for="cf_nombre">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                    Nombre del paciente
                </label>
                <input id="cf_nombre" type="text" wire:model="paciente_nombre" class="cori-input" placeholder="Escribe tu nombre completo" autocomplete="name">
                @error('paciente_nombre') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="cori-label" for="cf_telefono">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                    Teléfono
                </label>
                <input id="cf_telefono" type="tel" wire:model="telefono" class="cori-input" placeholder="Ej. +56 9 1234 5678" autocomplete="tel">
                @error('telefono') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="cori-label" for="cf_email">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                    Correo electrónico <span class="font-normal text-slate-400 dark:text-slate-500">(opcional)</span>
                </label>
                <input id="cf_email" type="email" wire:model="email" class="cori-input" placeholder="nombre@correo.com" autocomplete="email">
                @error('email') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Especialidad --}}
            <div>
                <label class="cori-label" for="cf_especialidad">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                    Especialidad
                </label>
                <div class="relative">
                    <select id="cf_especialidad" wire:model="especialidad_id" class="cori-input pr-10">
                        <option value="">Selecciona una especialidad</option>
                        @foreach($this->especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400 dark:text-slate-500" aria-hidden="true">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </div>
                @error('especialidad_id') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Fecha --}}
            <div>
                <label class="cori-label" for="cf_fecha">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                    Fecha de la cita
                </label>
                <input id="cf_fecha" type="date" wire:model="fecha" class="cori-input">
                @error('fecha') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Hora --}}
            <div>
                <label class="cori-label" for="cf_hora">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                    Hora preferida
                </label>
                <input id="cf_hora" type="time" wire:model="hora" class="cori-input">
                @error('hora') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            {{-- Notas --}}
            <div class="md:col-span-2">
                <label class="cori-label" for="cf_notas">
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                    Notas adicionales <span class="font-normal text-slate-400 dark:text-slate-500">(opcional)</span>
                </label>
                <textarea id="cf_notas" wire:model="notas" rows="3" class="cori-input resize-none" placeholder="Describe brevemente tu motivo de consulta..."></textarea>
                @error('notas') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

        </div>

        {{-- Footer --}}
        <div class="flex flex-col-reverse gap-4 border-t border-slate-100 pt-5 dark:border-slate-700 sm:flex-row sm:items-center sm:justify-between">
            <p class="flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">
                <svg class="h-4 w-4 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                Tus datos están protegidos y son confidenciales
            </p>
            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-7 py-3.5 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_26px_rgba(230,62,140,0.45)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2 dark:ring-offset-slate-900"
            >
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                Registrar cita
            </button>
        </div>
    </form>
</div>
