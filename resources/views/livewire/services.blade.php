@php
    $colors = ['bg-pink-500', 'bg-purple-500', 'bg-rose-500'];
@endphp

<section id="servicios" class="mx-auto mt-5 w-full max-w-7xl px-4 sm:px-6 lg:px-8">

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
                class="group relative overflow-hidden rounded-[2rem] shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow border-4 border-white/10"
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

              <!-- Icono en esquina superior izquierda -->
                <div class="absolute left-4 top-4 z-10">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/25 backdrop-blur-md border border-white/20 shadow-lg overflow-hidden">
                        
                        <img 
                            src="/images/logo.svg"             
                            class="w-full h-full scale-150 object-center translate-x-4"
                            alt="Icono del servicio"
                        >

                    </div>
                </div>

                <!-- Contenido -->
                <div class="relative z-10 p-6 flex flex-col justify-end h-full min-h-[320px]">
                    <!-- Título -->
                    <h3 class="text-2xl font-bold text-white">
                        {{ $service->nombre }}
                    </h3>

                    <!-- Línea -->
                    <div class="w-10 h-1 bg-gradient-to-r from-pink-500 to-purple-500 mt-3 mb-4 rounded-full"></div>

                    <!-- Descripción -->
                    <p class="text-white/80 text-sm leading-5">
                        {{ $service->descripcion }}
                    </p>

                    <!-- Botón -->
                    <div class="mt-4">
                        <a href="#"
                        class="inline-flex items-center gap-2 rounded-full border border-white/50 px-5 py-2 text-sm font-medium text-white backdrop-blur-sm transition-all duration-300 hover:bg-white hover:text-brand-pink">
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