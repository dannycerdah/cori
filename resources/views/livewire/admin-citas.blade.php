<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-primary-blue">Gestión de Citas</h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-success/10 border border-success text-success rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        <label class="block text-sm font-semibold text-text-dark mb-2">Filtrar por estado</label>
        <select wire:model="filtroEstado" class="px-4 py-2 border border-light-pink rounded-lg focus:ring-2 focus:ring-secondary-pink focus:border-transparent transition">
            <option value="">Todas las citas</option>
            <option value="pendiente">Pendiente</option>
            <option value="atendido">Atendido</option>
            <option value="cancelado">Cancelado</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gradient-to-r from-primary-blue to-secondary-pink text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Fecha</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Hora</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Paciente</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Teléfono</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Especialidad</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Estado</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-light-pink">
                @foreach ($citas as $cita)
                    <tr class="hover:bg-light-pink/5 transition">
                        <td class="px-6 py-4 text-sm text-text-dark">{{ $cita->fecha }}</td>
                        <td class="px-6 py-4 text-sm text-text-dark">{{ $cita->hora }}</td>
                        <td class="px-6 py-4 text-sm text-text-dark">{{ $cita->paciente->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-text-dark">{{ $cita->paciente->telefono }}</td>
                        <td class="px-6 py-4 text-sm text-text-dark">{{ $cita->especialidad->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-text-dark">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($cita->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                @elseif($cita->estado == 'atendido') bg-success/20 text-success
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <button wire:click="actualizarEstado({{ $cita->id }}, 'pendiente')" class="px-3 py-1 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition">Pendiente</button>
                            <button wire:click="actualizarEstado({{ $cita->id }}, 'atendido')" class="px-3 py-1 bg-success text-white rounded-full hover:bg-green-600 transition">Atendido</button>
                            <button wire:click="actualizarEstado({{ $cita->id }}, 'cancelado')" class="px-3 py-1 bg-red-500 text-white rounded-full hover:bg-red-600 transition">Cancelado</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>