@php
    $colors = ['bg-pink-500', 'bg-purple-500', 'bg-rose-500'];
@endphp

<section id="servicios" class="mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- GRID -->
    <div class="mt-14 grid gap-6 md:grid-cols-2 xl:grid-cols-3">

        @forelse($services as $service)

             @php
                // color dinámico
                $color = $colors[$loop->index % 3];

                // nombre limpio
                $name = strtolower(trim($service->nombre));

                // detectores
                $isPrenatal = $name === 'control prenatal';
                $isParto = $name === 'atención del parto' || $name === 'atencion del parto';
                $isPostparto = $name === 'cuidado postparto';

                // imagen base (default siempre)
                $image = !empty($service->imagen) ? $service->imagen : 'default.jpg';

                // sobrescribir casos especiales
                if ($isPrenatal) {
                    $image = 'control-prenatal.jpg';
                }

                if ($isParto) {
                    $image = 'parto.jpg';
                }

                if ($isPostparto) {
                    $image = 'postparto.jpg';
                }
            @endphp
             

            <article 
                wire:key="service-{{ $service->id }}"
                class="group relative overflow-hidden rounded-[2rem] shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow"
            >

                <!-- Imagen -->
                <div class="absolute inset-0">
                    <img 
                        src="{{ asset('images/services/' . $image) }}"
                        alt="{{ $service->nombre }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                    >
                </div>

                <!-- Overlay -->
                <div class="absolute inset-0 
                    {{ $isPrenatal 
                        ? 'bg-gradient-to-t from-black/80 via-pink-500/20 to-purple-500/20' 
                        : 'bg-gradient-to-t from-black/80 via-black/40 to-transparent' }}">
                </div>

                <!-- Contenido -->
                <div class="relative z-10 p-6 flex flex-col justify-end h-full min-h-[320px]">

                    <!-- Icono -->
                    <div class="mb-6">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl 
                            {{ $isPrenatal ? 'bg-white/20' : $color . '/80' }} backdrop-blur">

                            @if($isPrenatal)
                                <img 
                                    src="{{ asset('images/services/icono-control-prenatal.png') }}" 
                                    class="w-6 h-6"
                                >
                            @elseif($isParto)
                                <img 
                                    src="{{ asset('images/services/icono-parto.png') }}" 
                                    class="w-6 h-6"
                                >
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="white" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3c2.5 0 4 2 4 4v3" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 10c1.5 1 2 2.5 2 4a6 6 0 0 1-12 0c0-2 1-3.5 2.5-4.5" />
                                </svg>
                            @endif

                        </div>
                    </div>

                    <!-- Título -->
                    <h3 class="text-2xl font-bold text-white">
                        {{ $service->nombre }}
                    </h3>

                    <!-- Línea -->
                    <div class="w-10 h-1 bg-brand-pink mt-3 mb-4 rounded-full"></div>

                    <!-- Descripción -->
                    <p class="text-white/80 text-sm leading-6">
                        {{ $service->descripcion }}
                    </p>

                    <!-- Botón -->
                    <div class="mt-6">
                        <a href="#servicios"
                           class="inline-flex items-center gap-2 bg-white text-brand-pink px-5 py-2 rounded-full font-semibold text-sm hover:bg-brand-pink hover:text-white transition">
                            Más información →
                        </a>
                    </div>

                </div>

            </article>

        @empty
            <p class="col-span-full rounded-[2rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">
                No hay servicios disponibles por el momento.
            </p>
        @endforelse

    </div>

</section>