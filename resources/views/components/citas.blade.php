<section id="citas" class="mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-stretch">

        {{-- ======= BLOQUE IZQUIERDO (solo escritorio) ======= --}}
        <div class="relative hidden flex-col overflow-hidden rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900 md:p-10 lg:flex">

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
                    class="absolute inset-0 h-full w-full object-cover"
                    style="object-position: 75% 25%;"
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

                {{-- Header (compartido) --}}
                <div class="mb-7 space-y-5">
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
                </div>

                {{-- Mensajes (compartidos entre ambas versiones) --}}
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

                {{-- Versión de escritorio: formulario completo en una sola vista --}}
                <div class="hidden lg:block">
                    @include('components.citas.escritorio')
                </div>

                {{-- Versión móvil: asistente paso a paso --}}
                <div class="lg:hidden">
                    @include('components.citas.movil')
                </div>
            </div>
        </div>

    </div>
</section>
