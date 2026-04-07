<section>
	<div class="flex items-end justify-between gap-4">
		<div>
			<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-pink">Specialties</p>
			<h3 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white md:text-3xl">Especialidades medicas</h3>
		</div>
		<p class="hidden max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300 md:block">Cards claras, iconografia simple y suficiente espacio en blanco para favorecer lectura y confianza.</p>
	</div>

	<div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
		@forelse($especialidades as $especialidad)
			<article class="rounded-[1.75rem] bg-white p-6 shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow dark:bg-slate-900">
				<div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-blue to-brand-pink text-white">
					<svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5.25c1.657 0 3 1.343 3 3S13.657 11.25 12 11.25 9 9.907 9 8.25s1.343-3 3-3zm0 0c-4.28 0-7.75 3.47-7.75 7.75v.75h15.5V13c0-4.28-3.47-7.75-7.75-7.75z" />
					</svg>
				</div>
				<h4 class="mt-6 text-lg font-bold text-brand-blue dark:text-white">{{ $especialidad->nombre }}</h4>
				<p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $especialidad->descripcion ?? 'Atencion especializada y seguimiento cercano para cada necesidad clinica.' }}</p>
			</article>
		@empty
			<p class="col-span-full rounded-[1.75rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">No hay especialidades disponibles.</p>
		@endforelse
	</div>
</section>