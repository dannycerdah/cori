<section class="bg-white p-8 rounded-lg shadow-lg mx-4 mb-8">
    <h2 class="text-3xl font-bold text-primary-blue mb-6 text-center">Procedimientos Obstétricos</h2>
    <p class="text-center text-text-dark mb-8">Procedimientos quirúrgicos obstétricos realizados por especialistas expertos con todos los protocolos de seguridad.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($surgeries as $surgery)
            <div class="p-6 border border-light-pink rounded-lg bg-gradient-to-br from-white to-light-pink/10 hover:shadow-lg transition">
                <h3 class="text-secondary-pink font-bold text-lg mb-2">{{ $surgery->nombre }}</h3>
                <p class="text-text-dark">{{ $surgery->descripcion }}</p>
            </div>
        @empty
            <p class="text-center text-text-dark col-span-2">No hay procedimientos cargados.</p>
        @endforelse
    </div>
</section>
