<section>
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-text-dark mb-3">Especialidades Médicas</h2>
        <p class="text-text-muted max-w-xl mx-auto">Contamos con profesionales expertos en múltiples especialidades para brindar atención integral.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($especialidades as $especialidad)
            <div class="p-6 rounded-xl bg-white border border-slate-100 hover:shadow-md transition duration-200 hover:border-brand-purple group">
                <div class="w-12 h-12 rounded-lg bg-brand-light mb-4 group-hover:bg-brand-purple transition">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-brand-purple group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-text-dark text-lg mb-2">{{ $especialidad->nombre }}</h3>
                <p class="text-text-muted text-sm leading-relaxed">{{ $especialidad->descripcion ?? 'Atención especializada de alta calidad.' }}</p>
            </div>
        @empty
            <p class="text-center text-text-muted col-span-3 py-8">No hay especialidades disponibles.</p>
        @endforelse
    </div>
</section>
