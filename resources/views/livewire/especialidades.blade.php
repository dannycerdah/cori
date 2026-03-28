<section class="bg-white p-8 rounded-lg shadow-lg mx-4 mb-8">
    <h2 class="text-3xl font-bold text-primary-blue mb-6 text-center">Especialidades Médicas</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($especialidades as $especialidad)
            <div class="p-6 border border-light-pink rounded-lg bg-gradient-to-br from-white to-light-pink/10 hover:shadow-lg transition">
                <h3 class="font-bold text-secondary-pink text-lg mb-2">{{ $especialidad->nombre }}</h3>
                <p class="text-text-dark">{{ $especialidad->descripcion ?? 'Atención especializada de alta calidad.' }}</p>
            </div>
        @empty
            <p class="text-center text-text-dark">No hay especialidades cargadas aún.</p>
        @endforelse
    </div>
</section>
