<div class="bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-primary-blue text-center">Formulario de Cita</h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-success/10 border border-success text-success rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="reservar" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Nombre del paciente</label>
                <input type="text" wire:model="paciente_nombre" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" />
                @error('paciente_nombre') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Teléfono</label>
                <input type="text" wire:model="telefono" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" />
                @error('telefono') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Email (opcional)</label>
                <input type="email" wire:model="email" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" />
                @error('email') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Especialidad</label>
                <select wire:model="especialidad_id" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition">
                    <option value="">Seleccione una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
                @error('especialidad_id') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Fecha</label>
                <input type="date" wire:model="fecha" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" />
                @error('fecha') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-text-dark mb-2">Hora</label>
                <input type="time" wire:model="hora" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" />
                @error('hora') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-text-dark mb-2">Notas adicionales</label>
                <textarea wire:model="notas" class="w-full px-4 py-3 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition" rows="4" placeholder="Describa brevemente su motivo de consulta..."></textarea>
                @error('notas') <span class="text-secondary-pink text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-secondary-pink hover:bg-light-pink text-white font-bold py-3 px-8 rounded-full transition duration-300 shadow-lg hover:shadow-xl">
                Registrar Cita
            </button>
        </div>
    </form>
</div>