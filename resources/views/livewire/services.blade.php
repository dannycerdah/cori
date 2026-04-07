<section>
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-text-dark mb-3">Nuestros Servicios</h2>
        <p class="text-text-muted max-w-xl mx-auto">Ofrecemos soluciones médicas integrales para el cuidado especializado de la mujer.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="p-6 rounded-xl bg-white border border-slate-100 hover:shadow-md transition duration-200 hover:border-brand-purple">
                <div class="w-12 h-12 rounded-lg bg-brand-light mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-text-dark mb-2">{{ $service->nombre }}</h3>
                <p class="text-text-muted text-sm leading-relaxed">{{ $service->descripcion }}</p>
            </div>
        @empty
            <p class="text-center text-text-muted col-span-3 py-8">No hay servicios disponibles.</p>
        @endforelse
    </div>
</section>
