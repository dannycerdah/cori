{{-- Selector de fecha y hora según la disponibilidad real del servicio.
     Se usa tanto en la versión de escritorio como en el asistente móvil. --}}
@php
    $fechasDisp = $this->fechasDisponibles;
    $slotsDisp = $this->slotsDisponibles;
@endphp

<div class="space-y-4">
    {{-- Paso previo: hace falta elegir servicio --}}
    @if (! $this->servicioSeleccionado)
        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-400">
            Elige una especialidad y un servicio para ver las fechas disponibles.
        </div>
    @elseif (empty($fechasDisp))
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800 dark:border-amber-500/30 dark:bg-amber-500/10 dark:text-amber-300">
            No hay horarios disponibles para este servicio en los próximos {{ \App\Livewire\CitaForm::DIAS_VENTANA }} días.
        </div>
    @else
        {{-- Fechas disponibles (en filas, sin scroll horizontal) --}}
        <div>
            <span class="cori-label">Fecha disponible</span>
            <div class="mt-2 grid grid-cols-3 gap-2 sm:grid-cols-5 lg:grid-cols-7">
                @foreach ($fechasDisp as $f)
                    <button
                        type="button"
                        wire:click="elegirFecha('{{ $f['fecha'] }}')"
                        wire:key="fecha-{{ $f['fecha'] }}"
                        @class([
                            'rounded-xl border px-2 py-2 text-center transition',
                            'border-brand-pink bg-brand-pink text-white shadow-[0_4px_14px_rgba(230,62,140,0.35)]' => $fecha === $f['fecha'],
                            'border-slate-200 bg-white text-slate-600 hover:border-brand-pink/50 hover:text-brand-blue dark:border-white/10 dark:bg-slate-900 dark:text-slate-300' => $fecha !== $f['fecha'],
                        ])
                    >
                        <span class="block text-xs font-semibold capitalize leading-tight">{{ $f['etiqueta'] }}</span>
                        <span class="block text-[10px] {{ $fecha === $f['fecha'] ? 'text-white/80' : 'text-slate-400' }}">
                            {{ $f['cupos'] }} {{ \Illuminate\Support\Str::plural('cupo', $f['cupos']) }}
                        </span>
                    </button>
                @endforeach
            </div>
            @error('fecha') <span class="cori-error">{{ $message }}</span> @enderror
        </div>

        {{-- Horas disponibles para la fecha elegida --}}
        @if ($fecha)
            <div>
                <span class="cori-label">Hora disponible</span>
                @if (empty($slotsDisp))
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Ya no quedan horarios para esa fecha. Elige otra.</p>
                @else
                    <div class="mt-2 grid grid-cols-3 gap-2 sm:grid-cols-4">
                        @foreach ($slotsDisp as $s)
                            <button
                                type="button"
                                wire:click="elegirHora('{{ $s['hora_inicio'] }}')"
                                wire:key="slot-{{ $s['hora_inicio'] }}"
                                @class([
                                    'rounded-xl border px-2 py-2 text-sm font-semibold transition',
                                    'border-brand-pink bg-brand-pink text-white shadow-[0_4px_14px_rgba(230,62,140,0.35)]' => $hora === $s['hora_inicio'],
                                    'border-slate-200 bg-white text-slate-600 hover:border-brand-pink/50 hover:text-brand-blue dark:border-white/10 dark:bg-slate-900 dark:text-slate-300' => $hora !== $s['hora_inicio'],
                                ])
                            >
                                {{ $s['hora_inicio'] }}
                            </button>
                        @endforeach
                    </div>
                @endif
                @error('hora') <span class="cori-error">{{ $message }}</span> @enderror
            </div>
        @endif
    @endif
</div>
