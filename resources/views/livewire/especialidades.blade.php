<section class="py-14 md:py-20">
	<div class="grid gap-10 md:gap-12 md:grid-cols-2 md:items-center">

		
		<!-- TEXTO -->
		<div class="text-center md:text-left">
			<p class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold uppercase tracking-[0.32em] text-brand-pink bg-brand-pink/10 rounded-full">
				<span class="w-2 h-2 bg-brand-pink rounded-full animate-pulse"></span>
				Especialidades Médicas
			</p>

			<h3 class="mt-3 text-2xl sm:text-3xl md:text-4xl font-extrabold text-brand-blue dark:text-white leading-tight">
				Atención especializada con experiencia multidisciplinaria
			</h3>

			<p class="mt-4 md:mt-6 max-w-md mx-auto md:mx-0 text-sm sm:text-base leading-relaxed text-slate-600 dark:text-slate-300">
				Ofrecemos un equipo médico con experiencia en distintas áreas clínicas para brindar
				tratamientos integrales y un seguimiento cercano adaptado a tus necesidades.
			</p>

			<div class="mt-6 md:mt-8">
				<a href="#"
				class="inline-flex items-center gap-2 rounded-full border border-brand-pink/30 bg-brand-pink/5 px-6 py-3 text-sm font-medium text-brand-pink backdrop-blur-sm transition-all duration-300 hover:bg-brand-pink hover:text-white hover:border-brand-pink">
					Descubre nuestras especialidades →
				</a>
			</div>
		</div>

		<!-- IMAGEN (ARRIBA EN MÓVIL) -->
		<div class="flex justify-center order-first md:order-none">
			<div class="w-[95%] max-w-[380px] md:max-w-[420px] relative group overflow-hidden rounded-3xl shadow-xl ring-1 ring-white/20">

				<img
					src="/images/services/specialty-care.jpg"
					class="w-full h-[220px] sm:h-[260px] md:h-[300px] object-cover object-center transition-transform duration-700 group-hover:scale-105"
					alt="Especialidades médicas"
				/>

				<div class="absolute inset-0 bg-gradient-to-tr from-brand-pink/20 via-transparent to-white/10"></div>

				<!-- Overlay con icono -->
				<div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
					<div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20 backdrop-blur-md border border-white/30 shadow-lg">
						<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
						</svg>
					</div>
				</div>
			</div>
		</div>


	</div>

	<!-- CARDS -->
	<div class="mt-10 md:mt-12 grid gap-4 sm:gap-6 md:grid-cols-2">
		@forelse($especialidades as $index => $especialidad)

			<a href="#" class="group block">
				<article class="relative flex flex-col sm:flex-row items-start gap-4 sm:gap-5 overflow-hidden rounded-2xl md:rounded-[1.75rem] border border-white/20 bg-white/90 p-4 sm:p-5 md:p-6 shadow-card backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-brand-pink/40 hover:bg-white dark:border-white/10 dark:bg-slate-900/90 dark:hover:bg-slate-900 animate-fade-in-up"
					 style="animation-delay: {{ $index * 0.1 }}s">

					<div class="relative flex h-12 w-12 sm:h-14 sm:w-14 shrink-0 items-center justify-center rounded-xl sm:rounded-2xl bg-gradient-to-br from-brand-pink/20 to-brand-pink/5 text-brand-pink shadow-inner transition-all duration-300 group-hover:scale-110">
						<div class="absolute inset-0 rounded-2xl bg-brand-pink/10 blur-md opacity-0 group-hover:opacity-100 transition"></div>
						<svg class="relative h-6 w-6 sm:h-7 sm:w-7 stroke-[1.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-3.865 0-7 3.135-7 7v4a2 2 0 0 0 2 2h2v-2H7v-4a5 5 0 0 1 10 0v4h-2v2h2a2 2 0 0 0 2-2v-4c0-3.865-3.135-7-7-7z" />
						</svg>
					</div>

					<div class="flex-1">
						<h4 class="text-base sm:text-lg font-bold text-brand-blue transition-colors duration-300 group-hover:text-brand-pink dark:text-white">
							{{ $especialidad->nombre }}
						</h4>
						<p class="mt-1 sm:mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
							{{ $especialidad->descripcion ?? 'Atencion especializada y seguimiento cercano para cada necesidad clinica.' }}
						</p>
					</div>

					<div class="self-end sm:self-center flex h-9 w-9 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-brand-pink/10 text-brand-pink transition-all duration-300 group-hover:bg-brand-pink group-hover:text-white">
						→
					</div>

					<div class="absolute bottom-0 left-4 sm:left-6 h-1 w-8 sm:w-10 rounded-full bg-brand-pink transition-all duration-300 group-hover:w-16 sm:group-hover:w-24"></div>
				</article>
			</a>

		@empty
			<p class="col-span-full rounded-2xl bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">
				No hay especialidades disponibles.
			</p>
		@endforelse
	</div>
</section>