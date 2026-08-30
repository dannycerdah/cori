@php
    // Etiquetas y colores por estado de cita (clave = valor del enum en BD)
    $estadoLabels = [
        'REGISTRADA' => 'Registrada',
        'CONFIRMADA' => 'Confirmada',
        'ATENDIDA' => 'Atendida',
        'CANCELADA' => 'Cancelada',
        'NO_ASISTIO' => 'No asistió',
    ];
    $estadoBadge = [
        'REGISTRADA' => 'bg-amber-100 text-amber-800 dark:bg-amber-400/10 dark:text-amber-300',
        'CONFIRMADA' => 'bg-sky-100 text-sky-800 dark:bg-sky-400/10 dark:text-sky-300',
        'ATENDIDA' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-400/10 dark:text-emerald-300',
        'CANCELADA' => 'bg-rose-100 text-rose-800 dark:bg-rose-400/10 dark:text-rose-300',
        'NO_ASISTIO' => 'bg-slate-200 text-slate-700 dark:bg-white/10 dark:text-slate-300',
    ];
    $filaFondo = [
        'REGISTRADA' => 'bg-amber-50/70 text-amber-900 dark:bg-amber-400/5 dark:text-amber-200',
        'CONFIRMADA' => 'bg-sky-50/70 text-sky-900 dark:bg-sky-400/5 dark:text-sky-200',
        'ATENDIDA' => 'bg-emerald-50/70 text-emerald-900 dark:bg-emerald-400/5 dark:text-emerald-200',
        'CANCELADA' => 'bg-rose-50/70 text-rose-900 opacity-75 dark:bg-rose-400/5 dark:text-rose-200',
        'NO_ASISTIO' => 'bg-slate-100/80 text-slate-600 opacity-75 dark:bg-white/5 dark:text-slate-300',
    ];
    $filaBorde = [
        'REGISTRADA' => 'border-l-4 border-amber-400',
        'CONFIRMADA' => 'border-l-4 border-sky-400',
        'ATENDIDA' => 'border-l-4 border-emerald-400',
        'CANCELADA' => 'border-l-4 border-rose-400',
        'NO_ASISTIO' => 'border-l-4 border-slate-400',
    ];
@endphp

<div class="rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
    @if (session()->has('message'))
        <div class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-300">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- Indicadores del rango de fechas seleccionado --}}
    <div class="mb-6 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6">
        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 dark:border-white/10 dark:bg-white/5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total</p>
            <p class="mt-1 text-2xl font-extrabold text-brand-blue dark:text-white">{{ $resumen['total'] }}</p>
        </div>
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 dark:border-amber-400/20 dark:bg-amber-400/10">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700 dark:text-amber-300">Registradas</p>
            <p class="mt-1 text-2xl font-extrabold text-amber-800 dark:text-amber-200">{{ $resumen['REGISTRADA'] }}</p>
        </div>
        <div class="rounded-2xl border border-sky-200 bg-sky-50 px-4 py-3 dark:border-sky-400/20 dark:bg-sky-400/10">
            <p class="text-xs font-semibold uppercase tracking-wider text-sky-700 dark:text-sky-300">Confirmadas</p>
            <p class="mt-1 text-2xl font-extrabold text-sky-800 dark:text-sky-200">{{ $resumen['CONFIRMADA'] }}</p>
        </div>
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 dark:border-emerald-400/20 dark:bg-emerald-400/10">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-300">Atendidas</p>
            <p class="mt-1 text-2xl font-extrabold text-emerald-800 dark:text-emerald-200">{{ $resumen['ATENDIDA'] }}</p>
        </div>
        <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 dark:border-rose-400/20 dark:bg-rose-400/10">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700 dark:text-rose-300">Canceladas</p>
            <p class="mt-1 text-2xl font-extrabold text-rose-800 dark:text-rose-200">{{ $resumen['CANCELADA'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 dark:border-white/10 dark:bg-white/5">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">No asistió</p>
            <p class="mt-1 text-2xl font-extrabold text-slate-700 dark:text-slate-200">{{ $resumen['NO_ASISTIO'] }}</p>
        </div>
    </div>

    <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col gap-2">
            <label class="cori-label" for="filtroEstado">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 2v-6.586a1 1 0 00-.293-.707L3.293 6.293A1 1 0 013 5.586V3z" clip-rule="evenodd" /></svg>
                Filtrar por estado
            </label>
            <select id="filtroEstado" wire:model.live="filtroEstado" class="cori-input">
                <option value="">Todas las citas</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado }}">{{ $estadoLabels[$estado] }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-2">
            <label class="cori-label" for="fechaInicio">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                Fecha de inicio
            </label>
            <input type="date" id="fechaInicio" wire:model.live="fechaInicio" class="cori-input" max="{{ $fechaFin }}">
        </div>

        <div class="flex flex-col gap-2">
            <label class="cori-label" for="fechaFin">
                <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                Fecha de fin
            </label>
            <input type="date" id="fechaFin" wire:model.live="fechaFin" class="cori-input" min="{{ $fechaInicio }}">
        </div>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-white/10">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-white/10">
            <thead class="bg-gradient-to-r from-brand-blue to-brand-pink text-white">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Horario</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Paciente</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Especialidad</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Servicio</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white dark:divide-white/10 dark:bg-slate-900">
                @forelse ($citas as $cita)
                    <tr class="{{ $filaFondo[$cita->estado] ?? 'text-slate-600 dark:text-slate-300' }} transition hover:brightness-[0.97] dark:hover:brightness-125">
                        <td class="{{ $filaBorde[$cita->estado] ?? 'border-l-4 border-transparent' }} whitespace-nowrap px-6 py-4 text-sm">{{ $cita->fecha?->format('d/m/Y') }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">{{ \Illuminate\Support\Str::of($cita->hora_inicio)->substr(0, 5) }}–{{ \Illuminate\Support\Str::of($cita->hora_fin)->substr(0, 5) }}</td>
                        <td class="px-6 py-4 text-sm font-semibold">{{ $cita->paciente?->nombre_completo }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $cita->paciente?->telefono ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $cita->especialidad?->nombre }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $cita->servicio?->nombre ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">{{ $cita->doctor?->nombre_completo ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $estadoBadge[$cita->estado] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ $estadoLabels[$cita->estado] ?? $cita->estado }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($estados as $estado)
                                    <button
                                        wire:click="actualizarEstado({{ $cita->id }}, '{{ $estado }}')"
                                        @disabled($cita->estado === $estado)
                                        class="rounded-full border px-3 py-1 text-xs font-semibold transition disabled:cursor-not-allowed disabled:opacity-40
                                            @if($estado === 'REGISTRADA') border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100 dark:border-amber-400/20 dark:bg-amber-400/10 dark:text-amber-300
                                            @elseif($estado === 'CONFIRMADA') border-sky-200 bg-sky-50 text-sky-700 hover:bg-sky-100 dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-300
                                            @elseif($estado === 'ATENDIDA') border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-300
                                            @elseif($estado === 'CANCELADA') border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300
                                            @else border-slate-200 bg-slate-50 text-slate-600 hover:bg-slate-100 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 @endif">
                                        {{ $estadoLabels[$estado] }}
                                    </button>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No hay citas en el rango de fechas seleccionado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $citas->links() }}
    </div>
</div>
