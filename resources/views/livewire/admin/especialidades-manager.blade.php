<div class="rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
    @if (session()->has('message'))
        <div class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-400/20 dark:bg-emerald-400/10 dark:text-emerald-300">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-6 flex items-center gap-2 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M18 10A8 8 0 11.001 10 8 8 0 0118 10zm-8-4a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1zm0 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" /></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-2 sm:max-w-xs">
            <label class="cori-label" for="buscar">Buscar</label>
            <input id="buscar" type="text" wire:model.live.debounce.300ms="buscar" class="cori-input" placeholder="Nombre de la especialidad">
        </div>
        <button wire:click="abrirModal" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-2.5 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition hover:-translate-y-0.5">
            <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
            Nueva especialidad
        </button>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-white/10">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-white/10">
            <thead class="bg-gradient-to-r from-brand-blue to-brand-pink text-white">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Servicios</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white dark:divide-white/10 dark:bg-slate-900">
                @forelse ($especialidades as $especialidad)
                    <tr class="transition hover:bg-brand-soft/50 dark:hover:bg-white/5">
                        <td class="px-6 py-4 text-sm font-semibold text-brand-blue dark:text-white">{{ $especialidad->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $especialidad->descripcion ?: '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $especialidad->servicios_count }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <button wire:click="toggleEstado({{ $especialidad->id }})"
                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold transition
                                    {{ $especialidad->estado ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200 dark:bg-emerald-400/10 dark:text-emerald-300' : 'bg-slate-200 text-slate-600 hover:bg-slate-300 dark:bg-white/10 dark:text-slate-300' }}">
                                {{ $especialidad->estado ? 'Activa' : 'Inactiva' }}
                            </button>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <div class="flex justify-end gap-1.5">
                                <button wire:click="editar({{ $especialidad->id }})" class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:bg-transparent dark:text-slate-300">Editar</button>
                                <button wire:click="eliminar({{ $especialidad->id }})" wire:confirm="¿Eliminar esta especialidad?" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 transition hover:bg-rose-100 dark:border-rose-400/20 dark:bg-rose-400/10 dark:text-rose-300">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No hay especialidades registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $especialidades->links() }}</div>

    @if ($mostrarModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4"
             x-data x-on:keydown.escape.window="$wire.cerrarModal()">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" wire:click="cerrarModal"></div>

            <div class="relative w-full max-w-lg rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
                <h2 class="text-lg font-bold text-brand-blue dark:text-white">
                    {{ $editandoId ? 'Editar especialidad' : 'Nueva especialidad' }}
                </h2>

                <form wire:submit="guardar" class="mt-6 space-y-5">
                    <div>
                        <label class="cori-label" for="nombre">Nombre</label>
                        <input id="nombre" type="text" wire:model="nombre" class="cori-input" placeholder="Ej. Cardiología">
                        @error('nombre') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="cori-label" for="descripcion">Descripción <span class="font-normal text-slate-400">(opcional)</span></label>
                        <textarea id="descripcion" wire:model="descripcion" rows="3" class="cori-input resize-none" placeholder="Breve descripción de la especialidad"></textarea>
                        @error('descripcion') <span class="cori-error">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center gap-3 text-sm font-medium text-slate-700 dark:text-slate-200">
                        <input type="checkbox" wire:model="estado" class="h-4 w-4 rounded border-slate-300 text-brand-pink focus:ring-brand-pink">
                        Especialidad activa
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
