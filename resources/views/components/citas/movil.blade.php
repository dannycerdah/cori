{{-- Versión móvil del formulario de reserva: asistente paso a paso. --}}
@php
    $pasos = [
        1 => 'Tus datos',
        2 => 'Especialidad',
        3 => 'Fecha y hora',
        4 => 'Confirmar',
    ];
    $espSeleccionada = $especialidad_id ? $especialidades->firstWhere('id', (int) $especialidad_id) : null;
    $servSeleccionado = $servicio_id ? $servicios->firstWhere('id', (int) $servicio_id) : null;
@endphp

{{-- Progreso --}}
<div class="mb-6">
    <div class="flex items-center justify-between text-xs font-semibold text-slate-500 dark:text-slate-400">
        <span>Paso {{ $pasoActual }} de {{ $totalPasos }}</span>
        <span class="text-brand-pink">{{ $pasos[$pasoActual] }}</span>
    </div>
    <div class="mt-2 flex gap-1.5">
        @for ($i = 1; $i <= $totalPasos; $i++)
            <button
                type="button"
                @if ($i < $pasoActual) wire:click="irAPaso({{ $i }})" @endif
                @class([
                    'h-1.5 flex-1 rounded-full transition',
                    'bg-brand-pink' => $i <= $pasoActual,
                    'bg-slate-200 dark:bg-slate-700' => $i > $pasoActual,
                    'cursor-pointer' => $i < $pasoActual,
                ])
                aria-label="Ir al paso {{ $i }}"
            ></button>
        @endfor
    </div>
</div>

<form wire:submit.prevent="reservar" class="space-y-5" x-on:submit="sessionStorage.setItem('cori-scroll-restore', JSON.stringify({ y: window.scrollY, path: window.location.pathname }))">
    @csrf

    {{-- ================= PASO 1: datos del paciente ================= --}}
    @if ($pasoActual === 1)
        <div class="space-y-5" wire:key="paso-1">
            <div>
                <label class="cori-label" for="m-tipo_documento">Tipo de documento</label>
                <select id="m-tipo_documento" wire:model="tipo_documento" wire:change="buscarPaciente" class="cori-input">
                    <option value="">Selecciona tipo</option>
                    <option value="DNI">DNI</option>
                    <option value="CE">Carnet de Extranjería</option>
                </select>
                @error('tipo_documento') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-numero_documento">Número de documento</label>
                <input id="m-numero_documento" type="text" inputmode="numeric" wire:model="numero_documento" wire:blur="buscarPaciente" wire:change="buscarPaciente" wire:keydown.enter.prevent="buscarPaciente" class="cori-input" placeholder="Ingresa tu número de documento" autocomplete="off">
                @if($pacienteEncontrado)
                    <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">
                        <svg class="inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        Paciente encontrado - se actualizarán los datos
                    </p>
                @endif
                @error('numero_documento') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-paciente_nombres">Nombres del paciente</label>
                <input id="m-paciente_nombres" type="text" wire:model="paciente_nombres" class="cori-input" placeholder="Escribe tus nombres" autocomplete="given-name">
                @error('paciente_nombres') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-paciente_apellidos">Apellidos del paciente</label>
                <input id="m-paciente_apellidos" type="text" wire:model="paciente_apellidos" class="cori-input" placeholder="Escribe tus apellidos" autocomplete="family-name">
                @error('paciente_apellidos') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-telefono">Teléfono</label>
                <input id="m-telefono" type="tel" wire:model="telefono" class="cori-input" placeholder="Ej. +51 9 1234 5678" autocomplete="tel">
                @error('telefono') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-correo">Correo electrónico <span class="font-normal text-slate-400">(opcional)</span></label>
                <input id="m-correo" type="email" wire:model="correo" class="cori-input" placeholder="nombre@correo.com" autocomplete="email">
                @error('correo') <span class="cori-error">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- ================= PASO 2: especialidad y servicio ================= --}}
    @if ($pasoActual === 2)
        <div class="space-y-5" wire:key="paso-2">
            <div>
                <label class="cori-label" for="m-especialidad_id">Especialidad</label>
                <select id="m-especialidad_id" wire:model.live="especialidad_id" class="cori-input">
                    <option value="">Selecciona una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
                @error('especialidad_id') <span class="cori-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="cori-label" for="m-servicio_id">Servicio</label>
                <select id="m-servicio_id" wire:model.live="servicio_id" class="cori-input" @disabled(! $especialidad_id)>
                    <option value="">{{ $especialidad_id ? 'Selecciona un servicio' : 'Primero elige una especialidad' }}</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                @error('servicio_id') <span class="cori-error">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- ================= PASO 3: fecha y hora ================= --}}
    @if ($pasoActual === 3)
        <div class="space-y-5" wire:key="paso-3">
            @include('components.citas.disponibilidad')

            <div>
                <label class="cori-label" for="m-observacion">Observaciones adicionales <span class="font-normal text-slate-400">(opcional)</span></label>
                <textarea id="m-observacion" wire:model="observacion" rows="3" class="cori-input resize-none" placeholder="Describe brevemente tu motivo de consulta..."></textarea>
                @error('observacion') <span class="cori-error">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- ================= PASO 4: confirmación ================= --}}
    @if ($pasoActual === 4)
        <div class="space-y-4" wire:key="paso-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Revisa los datos antes de confirmar tu cita.</p>

            <dl class="divide-y divide-slate-200 rounded-2xl border border-slate-200 bg-white text-sm dark:divide-white/10 dark:border-white/10 dark:bg-slate-900">
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Paciente</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">{{ trim($paciente_nombres.' '.$paciente_apellidos) ?: '—' }}</dd>
                </div>
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Documento</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">{{ trim(($tipo_documento ?: '').' '.($numero_documento ?: '')) ?: '—' }}</dd>
                </div>
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Contacto</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">{{ $telefono ?: '—' }}@if($correo)<span class="block text-xs font-normal text-slate-400">{{ $correo }}</span>@endif</dd>
                </div>
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Especialidad</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">{{ $espSeleccionada?->nombre ?? '—' }}</dd>
                </div>
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Servicio</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">{{ $servSeleccionado?->nombre ?? '—' }}</dd>
                </div>
                <div class="flex justify-between gap-4 px-4 py-3">
                    <dt class="text-slate-500 dark:text-slate-400">Fecha y hora</dt>
                    <dd class="text-right font-medium text-brand-blue dark:text-white">
                        {{ $fecha ? ucfirst(\Illuminate\Support\Carbon::parse($fecha)->locale('es')->isoFormat('ddd D [de] MMMM')) : '—' }}
                        @if($hora) · {{ $hora }} @endif
                    </dd>
                </div>
                @if($observacion)
                    <div class="px-4 py-3">
                        <dt class="text-slate-500 dark:text-slate-400">Observaciones</dt>
                        <dd class="mt-1 text-brand-blue dark:text-white">{{ $observacion }}</dd>
                    </div>
                @endif
            </dl>

            <div class="flex items-start gap-3 rounded-2xl border border-brand-pink/15 bg-brand-mist/60 px-4 py-3 text-xs text-slate-600 dark:border-brand-pink/10 dark:bg-brand-pink/5 dark:text-slate-300">
                <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Te contactaremos en menos de 15 minutos para confirmar tu cita.
            </div>
        </div>
    @endif

    {{-- ================= Navegación ================= --}}
    <div class="flex items-center gap-3 pt-1">
        @if ($pasoActual > 1)
            <button type="button" wire:click="pasoAnterior" class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:text-slate-300">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Atrás
            </button>
        @endif

        @if ($pasoActual < $totalPasos)
            <button type="button" wire:click="siguientePaso" class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-3 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">
                Siguiente
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        @else
            <button type="submit" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-3 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">
                <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                Reservar cita
            </button>
        @endif
    </div>

    <p class="flex items-center justify-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">
        <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
        </svg>
        Tu información está protegida y es confidencial.
    </p>
</form>
