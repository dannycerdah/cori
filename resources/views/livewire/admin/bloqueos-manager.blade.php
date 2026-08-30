<div class="rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
    @if (session()->has('message'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-300">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_auto] lg:items-end">
        <div class="flex flex-col gap-2">
            <label class="cori-label" for="filtroDoctor">Doctor</label>
            <select id="filtroDoctor" wire:model.live="filtroDoctor" class="cori-input">
                <option value="">Todos</option>
                @foreach ($doctores as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-2">
            <label class="cori-label" for="filtroFecha">Fecha</label>
            <input id="filtroFecha" type="date" wire:model.live="filtroFecha" class="cori-input">
        </div>
        <button wire:click="abrirModal" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-2.5 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
            Nuevo bloqueo
        </button>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-white/10">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-white/10">
            <thead class="bg-gradient-to-r from-brand-blue to-brand-pink text-white">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Franja</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Motivo</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white dark:divide-white/10 dark:bg-slate-900">
                @forelse ($bloqueos as $bloqueo)
                    <tr class="transition hover:bg-brand-soft/50 dark:hover:bg-white/5">
                        <td class="px-6 py-4 text-sm font-semibold text-brand-blue dark:text-white">{{ $bloqueo->doctor?->nombre_completo }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $bloqueo->fecha->format('d/m/Y') }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ substr($bloqueo->hora_inicio, 0, 5) }}–{{ substr($bloqueo->hora_fin, 0, 5) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $bloqueo->motivo ?: '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <button wire:click="toggleEstado({{ $bloqueo->id }})"
                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold transition
                                    {{ $bloqueo->estado ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200 dark:bg-emerald-400/10 dark:text-emerald-300' : 'bg-slate-200 text-slate-600 hover:bg-slate-300 dark:bg-white/10 dark:text-slate-300' }}">
                                {{ $bloqueo->estado ? 'Activo' : 'Inactivo' }}
                            </button>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <div class="flex justify-end gap-1.5">
                                <button wire:click="editar({{ $bloqueo->id }})" class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:bg-transparent dark:text-slate-300">Editar</button>
                                <button wire:click="eliminar({{ $bloqueo->id }})" wire:confirm="¿Eliminar este bloqueo?" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No hay bloqueos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $bloqueos->links() }}</div>

    @if ($mostrarModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4"
             x-data x-on:keydown.escape.window="$wire.cerrarModal()">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" wire:click="cerrarModal"></div>

            <div class="relative w-full max-w-lg rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
                <h2 class="text-lg font-bold text-brand-blue dark:text-white">
                    {{ $editandoId ? 'Editar bloqueo' : 'Nuevo bloqueo' }}
                </h2>

                <form wire:submit="guardar" class="mt-6 space-y-5">
                    <div>
                        <label class="cori-label" for="doctor_id">Doctor</label>
                        <select id="doctor_id" wire:model="doctor_id" class="cori-input">
                            <option value="">Selecciona un doctor</option>
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->nombre_completo }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="cori-label" for="fecha">Fecha</label>
                        <input id="fecha" type="date" wire:model="fecha" class="cori-input">
                        @error('fecha') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
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
                    </div>

                    <div>
                        <label class="cori-label" for="motivo">Motivo <span class="font-normal text-slate-400">(opcional)</span></label>
                        <textarea id="motivo" wire:model="motivo" rows="3" class="cori-input resize-none" placeholder="Ej. Capacitación, vacaciones, licencia médica"></textarea>
                        @error('motivo') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center gap-3 text-sm font-medium text-slate-700 dark:text-slate-200">
                        <input type="checkbox" wire:model="estado" class="h-4 w-4 rounded border-slate-300 text-brand-pink focus:ring-brand-pink">
                        Bloqueo activo
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
