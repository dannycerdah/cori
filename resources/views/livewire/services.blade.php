<section class="bg-white p-8 rounded-lg shadow-lg mx-4 mb-8">
    <h2 class="text-3xl font-bold text-primary-blue mb-6 text-center">Nuestros Servicios</h2>
    <ul class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($services as $service)
            <li class="p-6 border border-light-pink rounded-lg bg-gradient-to-br from-white to-light-pink/10 hover:shadow-lg transition">
                <h3 class="text-secondary-pink font-bold text-lg mb-2">{{ $service->nombre }}</h3>
                <p class="text-text-dark">{{ $service->descripcion }}</p>
            </li>
        @empty
            <p class="text-center text-text-dark col-span-3">No hay servicios cargados.</p>
        @endforelse
    </ul>
</section>
