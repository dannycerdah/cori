<section id="citas" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-stretch">

        {{-- ======= BLOQUE IZQUIERDO ======= --}}
        <div class="relative flex flex-col overflow-hidden rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900 md:p-10">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Reserva de citas</span>
            </div>

            {{-- Título --}}
            <h2 class="mt-5 text-4xl font-extrabold leading-tight text-brand-blue dark:text-white md:text-5xl">
                Agenda tu<br>cita médica
            </h2>

            {{-- Línea decorativa --}}
            <div class="mt-4 h-1 w-12 rounded-full bg-brand-pink"></div>

            {{-- Descripción --}}
            <p class="mt-5 text-base leading-7 text-slate-500 dark:text-slate-300">
                Completa los datos y selecciona el horario que prefieras. Confirmaremos tu cita rápidamente.
            </p>

            {{-- Features --}}
            <div class="mt-8 space-y-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-pink/10">
                        <svg class="h-5 w-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-blue dark:text-white">Confirmación rápida</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Te contactamos en menos de 15 minutos para confirmar tu cita.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-pink/10">
                        <svg class="h-5 w-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-blue dark:text-white">Atención segura</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Protocolos de bioseguridad y estándares de calidad para tu tranquilidad.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-pink/10">
                        <svg class="h-5 w-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-blue dark:text-white">Especialistas de confianza</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Contamos con médicos especialistas altamente calificados.</p>
                    </div>
                </div>
            </div>

            {{-- Banner inferior: ocupa el espacio restante --}}
            <div class="relative mt-10 flex-1 overflow-hidden rounded-[1.5rem] bg-gradient-to-br from-sky-100 to-blue-50 dark:from-slate-800 dark:to-slate-700 sm:min-h-[260px]">

                <img
                    src="{{ asset('images/services/cita.jpg') }}"
                    alt="Médico especialista"
                    class="absolute inset-0 h-full w-full object-cover object-right-bottom"
                    onerror="this.style.display='none'"
                >

                <div class="absolute bottom-4 right-4 flex items-center gap-3 rounded-2xl bg-white/90 px-4 py-3 shadow-lg backdrop-blur-sm dark:bg-slate-900/90">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-pink/10">
                        <svg class="h-4 w-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-extrabold text-brand-blue dark:text-white">+10,000</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Pacientes atendidos<br>confían en nosotros</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======= BLOQUE DERECHO ======= --}}
        <div class="cori-panel rounded-[2rem] p-3 shadow-card md:p-5 lg:p-6">
            <div class="rounded-[2rem] bg-slate-50 p-6 shadow-sm dark:bg-slate-950/70 sm:p-8 lg:p-10">

                <div class="mb-7 space-y-5">
                    {{-- Header --}}
                    <div class="inline-flex items-center gap-3 rounded-full bg-slate-100 px-4 py-2.5 dark:bg-slate-800">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-blue">
                            <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-brand-blue dark:text-white">Formulario de reserva</span>						
                    </div>


					{{-- Línea decorativa --}}
            		<div class="mt-4 h-1 w-12 rounded-full bg-brand-pink"></div>

                    {{-- Stepper --}}
                    <div class="flex items-center">
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
                </div>

                @if ($successMessage)
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 dark:border-emerald-500/25 dark:bg-emerald-500/10 dark:text-emerald-300">
                        <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ $successMessage }}
                    </div>
                @endif

                @if ($errorMessage)
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-700 dark:border-rose-500/30 dark:bg-rose-500/10 dark:text-rose-300">
                        <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10A8 8 0 114.293 4.293a8 8 0 0113.414 0A7.96 7.96 0 0118 10zm-8-4a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1zm0 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
                        </svg>
                        {{ $errorMessage }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-sm text-amber-800 dark:border-amber-500/30 dark:bg-amber-500/10 dark:text-amber-300">
                        <p class="font-semibold">Revisa estos campos para continuar:</p>
                        <p class="mt-1">{{ $errors->first() }}</p>
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 dark:border-emerald-500/25 dark:bg-emerald-500/10 dark:text-emerald-300">
                        <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="reservar" method="POST" action="{{ route('citas.store') }}" class="space-y-5" x-on:submit="sessionStorage.setItem('cori-scroll-restore', JSON.stringify({ y: window.scrollY, path: window.location.pathname }))">
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
                            <label class="cori-label" for="paciente_nombre">
                                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                Nombre del paciente
                            </label>
                            <input id="paciente_nombre" name="paciente_nombre" type="text" wire:model="paciente_nombre" class="cori-input" placeholder="Escribe tu nombre completo" autocomplete="name">
                            @error('paciente_nombre') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="cori-label" for="email">
                                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                                Correo electrónico
                            </label>
                            <input id="email" name="email" type="email" wire:model="email" class="cori-input" placeholder="nombre@correo.com" autocomplete="email">
                            @error('email') <span class="cori-error">{{ $message }}</span> @enderror
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
                                <select id="especialidad_id" name="especialidad_id" wire:model="especialidad_id" class="cori-input pr-10">
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
                            <label class="cori-label" for="fecha">
                                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                Fecha preferida
                            </label>
                            <input id="fecha" name="fecha" type="date" wire:model="fecha" class="cori-input">
                            @error('fecha') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="cori-label" for="hora">
                                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                                Hora preferida
                            </label>
                            <input id="hora" name="hora" type="time" wire:model="hora" class="cori-input">
                            @error('hora') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="cori-label" for="notas">
                                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                                Notas adicionales
                                <span class="font-normal text-slate-400 dark:text-slate-500">(opcional)</span>
                            </label>
                            <textarea id="notas" name="notas" wire:model="notas" rows="3" class="cori-input resize-none" placeholder="Describe brevemente tu motivo de consulta..."></textarea>
                            @error('notas') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div id="paciente-busqueda-result" class="hidden mt-2 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                        Paciente encontrado automáticamente.
                    </div>

                    <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-900/50">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Confirmación en menos de 15 minutos</p>
                            <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">Nos comunicaremos contigo para confirmar tu cita y resolver tus dudas.</p>
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-brand-pink via-purple-500 to-brand-blue px-7 py-4 text-sm font-semibold text-white shadow-[0_6px_24px_rgba(230,62,140,0.4)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_32px_rgba(230,62,140,0.55)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2 dark:ring-offset-slate-900">
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

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const endpoint = '{{ route('pacientes.buscar') }}';
                        const tipoInput = document.getElementById('tipo_documento');
                        const numeroInput = document.getElementById('numero_documento');
                        const nombreInput = document.getElementById('paciente_nombre');
                        const emailInput = document.getElementById('email');
                        const telefonoInput = document.getElementById('telefono');
                        const resultMessage = document.getElementById('paciente-busqueda-result');

                        if (!tipoInput || !numeroInput || !nombreInput || !emailInput || !telefonoInput) return;

                        function dispatchInput(el) { if (el) el.dispatchEvent(new Event('input', { bubbles: true })); }
                        function showResult(found) { if (resultMessage) resultMessage.classList.toggle('hidden', !found); }
                        function debounce(fn, delay = 300) {
                            let timer;
                            return function (...args) { clearTimeout(timer); timer = setTimeout(() => fn.apply(this, args), delay); };
                        }

                        async function buscarPacienteJS() {
                            const tipo = tipoInput.value.trim();
                            const numero = numeroInput.value.trim();
                            if (!tipo || !numero || numero.length < 8 || numero.length > 10) {
                                [nombreInput, emailInput, telefonoInput].forEach(el => { el.value = ''; dispatchInput(el); });
                                showResult(false); return;
                            }
                            try {
                                const url = `${endpoint}?tipo_documento=${encodeURIComponent(tipo)}&numero_documento=${encodeURIComponent(numero)}`;
                                const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
                                if (!response.ok) { [nombreInput, emailInput, telefonoInput].forEach(el => { el.value = ''; dispatchInput(el); }); showResult(false); return; }
                                const data = await response.json();
                                if (data.found && data.paciente) {
                                    nombreInput.value = data.paciente.nombre || '';
                                    emailInput.value = data.paciente.email || '';
                                    telefonoInput.value = data.paciente.telefono || '';
                                    [nombreInput, emailInput, telefonoInput].forEach(dispatchInput);
                                    showResult(true);
                                } else {
                                    [nombreInput, emailInput, telefonoInput].forEach(el => { el.value = ''; dispatchInput(el); });
                                    showResult(false);
                                }
                            } catch (e) {
                                [nombreInput, emailInput, telefonoInput].forEach(el => { el.value = ''; dispatchInput(el); });
                                showResult(false);
                            }
                        }

                        const debouncedBuscar = debounce(buscarPacienteJS, 300);
                        tipoInput.addEventListener('change', buscarPacienteJS);
                        numeroInput.addEventListener('blur', buscarPacienteJS);
                        numeroInput.addEventListener('change', buscarPacienteJS);
                        numeroInput.addEventListener('keydown', e => { if (e.key === 'Enter') { e.preventDefault(); buscarPacienteJS(); } });
                        numeroInput.addEventListener('input', debouncedBuscar);
                    });
                </script>
            </div>
        </div>

    </div>
</section>