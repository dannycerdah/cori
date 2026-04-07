<section>
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-text-dark mb-3">Procedimientos Obstétricos</h2>
        <p class="text-text-muted max-w-xl mx-auto">Procedimientos quirúrgicos realizados por especialistas expertos con todos los protocolos de seguridad y calidad.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($surgeries as $surgery)
            <div class="p-6 rounded-xl bg-white border border-slate-100 hover:shadow-md transition duration-200 hover:border-brand-purple">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-brand-light flex-shrink-0 flex items-center justify-center">
                        <svg class="w-5 h-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.452a6 6 0 00-3.86.454l-.612.054a6 6 0 00-2.766 1.146l-.744.668a2 2 0 00-.364 2.7l.455.554c.54.65.718 1.537.37 2.382-.368.885-1.263 1.46-2.249 1.45-1.568-.13-2.948-1.43-2.948-3.002 0-.567.163-1.123.466-1.594l2.944-4.416c.173-.261.432-.408.71-.408.278 0 .537.147.71.408l2.944 4.416c.303.471.466 1.027.466 1.594 0 1.572-1.38 2.872-2.948 3.002-.986.01-1.881-.565-2.249-1.45-.348-.845-.17-1.732.37-2.382l.455-.554a2 2 0 00-.364-2.7l-.744-.668a6 6 0 00-2.766-1.146l-.612-.054a6 6 0 00-3.86-.454l-2.387.452a2 2 0 00-1.022.547m15.18 0A2 2 0 09.878 6.572m15.18 0c.51.769.78 1.7.78 2.654v5.385a3 3 0 01-3 3H6.003a3 3 0 01-3-3V9.226a3 3 0 01.78-2.654m15.18 0A2.973 2.973 0 0012 3c-1.105 0-2.159.283-3.07.778M15 6.5a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-text-dark mb-1">{{ $surgery->nombre }}</h3>
                        <p class="text-text-muted text-sm leading-relaxed">{{ $surgery->descripcion }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-text-muted col-span-2 py-8">No hay procedimientos disponibles.</p>
        @endforelse
    </div>
</section>
