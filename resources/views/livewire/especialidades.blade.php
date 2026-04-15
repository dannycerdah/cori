<section>
	<div class="flex items-end justify-between gap-4">
		<div>
			<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-pink">Specialties</p>
			<h3 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white md:text-3xl">Especialidades medicas</h3>
		</div>		
	</div>

	<div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
		@forelse($especialidades as $especialidad)
			<article class="group overflow-hidden rounded-[1.75rem] bg-white shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow dark:bg-slate-900">
				<div class="relative aspect-[16/10] overflow-hidden">
					<img src="{{ $especialidad->card_image }}" alt="{{ $especialidad->nombre }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
					<div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-slate-900/18 to-transparent"></div>
					<div class="absolute inset-x-5 bottom-4 inline-flex w-fit items-center rounded-full border border-white/20 bg-white/12 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-white/92 backdrop-blur-md">
						{{ $especialidad->nombre }}
					</div>
				</div>
				<div class="p-6">
					<h4 class="text-lg font-bold text-brand-blue dark:text-white">{{ $especialidad->nombre }}</h4>
					<p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $especialidad->descripcion ?? 'Atencion especializada y seguimiento cercano para cada necesidad clinica.' }}</p>
				</div>
			</article>
		@empty
			<p class="col-span-full rounded-[1.75rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">No hay especialidades disponibles.</p>
		@endforelse
	</div>
</section>