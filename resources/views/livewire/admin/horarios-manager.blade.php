<div class="rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
    @if (session()->has('message'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-300">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-2 sm:max-w-xs">
            <label class="cori-label" for="filtroServicio">Servicio</label>
            <select id="filtroServicio" wire:model.live="filtroServicio" class="cori-input">
                <option value="">Todos</option>
                @foreach ($servicios as $servicio)
                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }} ({{ $servicio->especialidad?->nombre }})</option>
                @endforeach
            </select>
        </div>
        <button wire:click="abrirModal" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-2.5 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
            Nuevo horario
        </button>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-white/10">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-white/10">
            <thead class="bg-gradient-to-r from-brand-blue to-brand-pink text-white">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Servicio</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Franja</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Vigencia</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Frec. / Cap.</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Días</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white dark:divide-white/10 dark:bg-slate-900">
                @forelse ($horarios as $horario)
                    <tr class="transition hover:bg-brand-soft/50 dark:hover:bg-white/5">
                        <td class="px-6 py-4 text-sm font-semibold text-brand-blue dark:text-white">
                            {{ $horario->servicio?->nombre }}
                            <span class="block text-xs font-normal text-slate-400">{{ $horario->servicio?->especialidad?->nombre }}</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $horario->doctor?->nombre_completo ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ substr($horario->hora_inicio, 0, 5) }}–{{ substr($horario->hora_fin, 0, 5) }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                            @if ($horario->fecha_inicio || $horario->fecha_fin)
                                {{ $horario->fecha_inicio?->format('d/m/Y') ?? '…' }} – {{ $horario->fecha_fin?->format('d/m/Y') ?? '…' }}
                            @else
                                <span class="text-slate-400">Permanente</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $horario->frecuencia_minutos }} min / {{ $horario->capacidad }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                            @foreach ($horario->dias->pluck('dia_semana')->sort() as $d)
                                <span class="mr-1 inline-flex rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600 dark:bg-white/10 dark:text-slate-300">{{ \Illuminate\Support\Str::of($dias[$d])->substr(0, 3) }}</span>
                            @endforeach
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <button wire:click="toggleEstado({{ $horario->id }})"
                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold transition
                                    {{ $horario->estado ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200 dark:bg-emerald-400/10 dark:text-emerald-300' : 'bg-slate-200 text-slate-600 hover:bg-slate-300 dark:bg-white/10 dark:text-slate-300' }}">
                                {{ $horario->estado ? 'Activo' : 'Inactivo' }}
                            </button>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <div class="flex justify-end gap-1.5">
                                <button wire:click="editar({{ $horario->id }})" class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:bg-transparent dark:text-slate-300">Editar</button>
                                <button wire:click="eliminar({{ $horario->id }})" wire:confirm="¿Eliminar este horario?" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No hay horarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $horarios->links() }}</div>

    @if ($mostrarModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4"
             x-data x-on:keydown.escape.window="$wire.cerrarModal()">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" wire:click="cerrarModal"></div>

            <div class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
                <h2 class="text-lg font-bold text-brand-blue dark:text-white">
                    {{ $editandoId ? 'Editar horario' : 'Nuevo horario' }}
                </h2>

                <form wire:submit="guardar" class="mt-6 space-y-5">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="cori-label" for="servicio_id">Servicio</label>
                            <select id="servicio_id" wire:model="servicio_id" class="cori-input">
                                <option value="">Selecciona un servicio</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }} ({{ $servicio->especialidad?->nombre }})</option>
                                @endforeach
                            </select>
                            @error('servicio_id') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="cori-label" for="doctor_id">Doctor <span class="font-normal text-slate-400">(opcional según el servicio)</span></label>
                            <select id="doctor_id" wire:model="doctor_id" class="cori-input">
                                <option value="">Sin doctor asignado</option>
                                @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}</option>
                                @endforeach
                            </select>
                            @error('doctor_id') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <p class="cori-label mb-0">Vigencia <span class="font-normal text-slate-400">(opcional — deja ambas vacías si el horario no tiene fecha límite)</span></p>
                        </div>
                        <div>
                            <label class="cori-label" for="fecha_inicio">Fecha de inicio</label>
                            <input id="fecha_inicio" type="date" wire:model="fecha_inicio" class="cori-input">
                            @error('fecha_inicio') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="cori-label" for="fecha_fin">Fecha de fin</label>
                            <input id="fecha_fin" type="date" wire:model="fecha_fin" class="cori-input" min="{{ $fecha_inicio }}">
                            @error('fecha_fin') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="cori-label" for="hora_inicio">Hora de inicio</label>
                            <input id="hora_inicio" type="time" wire:model="hora_inicio" class="cori-input">
                            @error('hora_inicio') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="cori-label" for="hora_fin">Hora de fin</label>
                            <input id="hora_fin" type="time" wire:model="hora_fin" class="cori-input">
                            @error('hora_fin') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="cori-label" for="frecuencia_minutos">Frecuencia (minutos)</label>
                            <input id="frecuencia_minutos" type="number" min="1" wire:model="frecuencia_minutos" class="cori-input">
                            @error('frecuencia_minutos') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="cori-label" for="capacidad">Capacidad por slot</label>
                            <input id="capacidad" type="number" min="1" wire:model="capacidad" class="cori-input">
                            @error('capacidad') <span class="cori-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <span class="cori-label">Días de la semana</span>
                        <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-4">
                            @foreach ($dias as $num => $label)
                                <label class="flex items-center gap-2.5 rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700 dark:border-white/10 dark:text-slate-200">
                                    <input type="checkbox" value="{{ $num }}" wire:model="dias_semana" class="h-4 w-4 rounded border-slate-300 text-brand-pink focus:ring-brand-pink">
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        @error('dias_semana') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center gap-3 text-sm font-medium text-slate-700 dark:text-slate-200">
                        <input type="checkbox" wire:model="estado" class="h-4 w-4 rounded border-slate-300 text-brand-pink focus:ring-brand-pink">
                        Horario activo
                    </label>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" wire:click="cerrarModal" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:text-slate-300">Cancelar</button>
                        <button type="submit" class="rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-2.5 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
