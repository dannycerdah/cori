<section class="py-14 md:py-20">
	<div class="grid gap-10 md:gap-12 md:grid-cols-2 md:items-center">
		
		<!-- IMAGEN (ARRIBA EN MÓVIL) -->
		<div class="flex justify-center order-first md:order-none">
			<div class="w-[95%] max-w-[380px] md:max-w-[420px] relative group overflow-hidden rounded-3xl shadow-xl ring-1 ring-white/20">
				
				<img 
					src="/images/services/imaging-care.jpg" 
					class="w-full h-[220px] sm:h-[260px] md:h-[300px] object-cover object-center transition-transform duration-700 group-hover:scale-105"
					alt="Ecografía especializada"
				/>

				<div class="absolute inset-0 bg-gradient-to-tr from-brand-pink/20 via-transparent to-white/10"></div>
				
				<!-- Overlay con icono -->
				<div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
					<div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20 backdrop-blur-md border border-white/30 shadow-lg">
						<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<rect x="3" y="5" width="18" height="14" rx="3"/>
							<path d="M5 13c2-3 4 3 6 0s4-3 6 0"/>
							<circle cx="12" cy="11" r="1.2"/>
						</svg>
					</div>
				</div>
			</div>
		</div>

		<!-- TEXTO -->
		<div class="text-center md:text-left">
			<p class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold uppercase tracking-[0.32em] text-brand-pink bg-brand-pink/10 rounded-full">
				<span class="w-2 h-2 bg-brand-pink rounded-full animate-pulse"></span>
				Ecografías Especializadas
			</p>

			<h3 class="mt-3 text-2xl sm:text-3xl md:text-4xl font-extrabold text-brand-blue dark:text-white leading-tight">
				Tecnología de vanguardia para el cuidado materno-infantil
			</h3>

			<p class="mt-4 md:mt-6 max-w-md mx-auto md:mx-0 text-sm sm:text-base leading-relaxed text-slate-600 dark:text-slate-300">
				Utilizamos equipos de última generación para ofrecer diagnósticos precisos y 
				monitoreo continuo durante todas las etapas del embarazo, garantizando la 
				seguridad y bienestar de madre e hijo.
			</p>

			<div class="mt-6 md:mt-8">
				<a href="#"
				class="inline-flex items-center gap-2 rounded-full border border-brand-pink/30 bg-brand-pink/5 px-6 py-3 text-sm font-medium text-brand-pink backdrop-blur-sm transition-all duration-300 hover:bg-brand-pink hover:text-white hover:border-brand-pink">
					Ver todas las ecografías →
				</a>
			</div>
		</div>

	</div>

	<!-- CARDS -->
	<div class="mt-10 md:mt-12 grid gap-4 sm:gap-6 md:grid-cols-2">
		@forelse($ecografias as $index => $ecografia)

			@php
				$tipo = $ecografia->tipo ?? strtolower($ecografia->nombre);

				if (str_contains($tipo, '3')) $tipo = '3d';
				elseif (str_contains($tipo, 'doppler')) $tipo = 'doppler';
				elseif (str_contains($tipo, 'obstetr')) $tipo = 'obstetrica';
				elseif (str_contains($tipo, 'trans')) $tipo = 'transvaginal';
				else $tipo = 'general';
			@endphp

			<a href="#" class="group block">
				<article class="relative flex flex-col sm:flex-row items-start gap-4 sm:gap-5 overflow-hidden rounded-2xl md:rounded-[1.75rem] border border-white/20 bg-white/90 p-4 sm:p-5 md:p-6 shadow-card backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-brand-pink/40 hover:bg-white dark:border-white/10 dark:bg-slate-900/90 dark:hover:bg-slate-900 animate-fade-in-up" 
				         style="animation-delay: {{ $index * 0.1 }}s">
					
					<!-- ICONO -->
					<div class="relative flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-xl sm:rounded-2xl 
						bg-gradient-to-br from-brand-pink/20 to-brand-pink/5 
						text-brand-pink shadow-inner transition-all duration-300 group-hover:scale-110">

						<!-- Glow -->
						<div class="absolute inset-0 rounded-2xl bg-brand-pink/10 blur-md opacity-0 group-hover:opacity-100 transition"></div>

						<!-- SVG -->
						<svg class="relative h-6 w-6 sm:h-7 sm:w-7 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">				 
							<rect x="3" y="5" width="18" height="14" rx="3"/>
							<path d="M7 10h10"/>
							<path d="M7 14h6"/>
							<circle cx="16" cy="14" r="2"/>
							<path d="M19 19l-1.5-1.5"/>											
						</svg>
					</div>

					<!-- CONTENIDO -->
					<div class="flex-1">
						<h4 class="text-base sm:text-lg font-bold text-brand-blue transition-colors duration-300 group-hover:text-brand-pink dark:text-white">
							{{ $ecografia->nombre }}
						</h4>

						<p class="mt-1 sm:mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
							{{ $ecografia->descripcion }}
						</p>
					</div>

					<!-- FLECHA -->
					<div class="self-end sm:self-center flex h-9 w-9 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-brand-pink/10 text-brand-pink transition-all duration-300 group-hover:bg-brand-pink group-hover:text-white">
						→
					</div>

					<!-- LINEA -->
					<div class="absolute bottom-0 left-4 sm:left-6 h-1 w-8 sm:w-10 rounded-full bg-brand-pink transition-all duration-300 group-hover:w-16 sm:group-hover:w-24"></div>

				</article>
			</a>

		@empty
			<p class="col-span-full rounded-2xl bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">
				No hay ecografías disponibles.
			</p>
		@endforelse

	</div>
</section>