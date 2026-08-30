{{-- Versión de escritorio del formulario de reserva: todos los campos en una vista. --}}

{{-- Stepper decorativo --}}
<div class="mb-7 flex items-center">
    <div class="flex flex-col items-center gap-1.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-pink text-xs font-bold text-white shadow-[0_4px_14px_rgba(230,62,140,0.4)]">1</span>
        <span class="text-[10px] font-semibold text-brand-pink">Ingresar Datos</span>
    </div>
    <div class="mb-4 h-px flex-1 bg-slate-200 dark:bg-slate-700"></div>
    <div class="flex flex-col items-center gap-1.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-200 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-400">2</span>
        <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">Reservar</span>
    </div>
    <div class="mb-4 h-px flex-1 bg-slate-200 dark:bg-slate-700"></div>
    <div class="flex flex-col items-center gap-1.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-200 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-400">3</span>
        <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">Confirmar</span>
    </div>
    <div class="mb-4 h-px flex-1 bg-slate-200 dark:bg-slate-700"></div>
    <div class="flex flex-col items-center gap-1.5">
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-200 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-400">
            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
            </svg>
        </span>
        <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">¡Listo!</span>
    </div>
</div>

<form wire:submit.prevent="reservar" class="space-y-5" x-on:submit="sessionStorage.setItem('cori-scroll-restore', JSON.stringify({ y: window.scrollY, path: window.location.pathname }))">
    @csrf
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <label class="cori-label" for="tipo_documento">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                Tipo de documento
            </label>
            <div class="relative">
                <select id="tipo_documento" name="tipo_documento" wire:model="tipo_documento" wire:change="buscarPaciente" class="cori-input pr-10">
                    <option value="">Selecciona tipo</option>
                    <option value="DNI">DNI</option>
                    <option value="CE">Carnet de Extranjería</option>
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400 dark:text-slate-500" aria-hidden="true">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
            </div>
            @error('tipo_documento') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="numero_documento">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                Número de documento
            </label>
            <input id="numero_documento" name="numero_documento" type="text" wire:model="numero_documento" wire:blur="buscarPaciente" wire:change="buscarPaciente" wire:keydown.enter.prevent="buscarPaciente" class="cori-input" placeholder="Ingresa tu número de documento" autocomplete="off">
            @if($pacienteEncontrado)
                <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">
                    <svg class="inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    Paciente encontrado - se actualizarán los datos
                </p>
            @endif
            @error('numero_documento') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="paciente_nombres">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                Nombres del paciente
            </label>
            <input id="paciente_nombres" name="paciente_nombres" type="text" wire:model="paciente_nombres" class="cori-input" placeholder="Escribe tus nombres" autocomplete="given-name">
            @error('paciente_nombres') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="paciente_apellidos">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                Apellidos del paciente
            </label>
            <input id="paciente_apellidos" name="paciente_apellidos" type="text" wire:model="paciente_apellidos" class="cori-input" placeholder="Escribe tus apellidos" autocomplete="family-name">
            @error('paciente_apellidos') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="correo">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                Correo electrónico
            </label>
            <input id="correo" name="correo" type="email" wire:model="correo" class="cori-input" placeholder="nombre@correo.com" autocomplete="email">
            @error('correo') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="telefono">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                Teléfono
            </label>
            <input id="telefono" name="telefono" type="tel" wire:model="telefono" class="cori-input" placeholder="Ej. +51 9 1234 5678" autocomplete="tel">
            @error('telefono') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="especialidad_id">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                Especialidad
            </label>
            <div class="relative">
                <select id="especialidad_id" name="especialidad_id" wire:model.live="especialidad_id" class="cori-input pr-10">
                    <option value="">Selecciona una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400 dark:text-slate-500" aria-hidden="true">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
            </div>
            @error('especialidad_id') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="cori-label" for="servicio_id">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                Servicio
            </label>
            <div class="relative">
                <select id="servicio_id" name="servicio_id" wire:model.live="servicio_id" class="cori-input pr-10" @disabled(! $especialidad_id)>
                    <option value="">
                        {{ $especialidad_id ? 'Selecciona un servicio' : 'Primero elige una especialidad' }}
                    </option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400 dark:text-slate-500" aria-hidden="true">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
            </div>
            @error('servicio_id') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        <div class="md:col-span-2">
            @include('components.citas.disponibilidad')
        </div>

        <div class="md:col-span-2">
            <label class="cori-label" for="observacion">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                Observaciones adicionales
                <span class="font-normal text-slate-400 dark:text-slate-500">(opcional)</span>
            </label>
            <textarea id="observacion" name="observacion" wire:model="observacion" rows="3" class="cori-input resize-none" placeholder="Describe brevemente tu motivo de consulta..."></textarea>
            @error('observacion') <span class="cori-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="flex items-center gap-4 rounded-[1.75rem] border border-brand-pink/15 bg-gradient-to-r from-white via-slate-50 to-sky-50 px-5 py-4 shadow-sm shadow-brand-pink/10 dark:border-brand-pink/10 dark:from-slate-900 dark:via-slate-950 dark:to-slate-900 dark:text-slate-200">
        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-pink/10 text-brand-pink ring-1 ring-brand-pink/20 dark:bg-brand-pink/20 dark:ring-brand-pink/30">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-brand-blue dark:text-white">Confirmación en menos de 15 minutos</p>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Nos comunicaremos contigo para confirmar tu cita y resolver tus dudas.</p>
        </div>
    </div>

    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-7 py-3.5 text-[15px] font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_26px_rgba(230,62,140,0.45)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2">
        <span class="relative flex items-center justify-center gap-2.5">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            Reservar cita ahora
        </span>
    </button>

    <p class="flex items-center justify-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">
        <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
        </svg>
        Tu información está protegida y es confidencial.
    </p>
</form>
