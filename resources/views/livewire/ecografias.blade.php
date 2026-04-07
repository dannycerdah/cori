<section>
	<div class="flex items-end justify-between gap-4">
		<div>
			<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-pink">Imaging care</p>
			<h3 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white md:text-3xl">Ecografias y monitoreo avanzado</h3>
		</div>
		<p class="hidden max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300 md:block">Equipos modernos para control, seguimiento y diagnostico oportuno con una interfaz visual clara.</p>
	</div>

	<div class="mt-8 grid gap-6 md:grid-cols-2">
		@forelse($ecografias as $ecografia)
			<article class="rounded-[1.75rem] border border-brand-soft bg-white p-6 shadow-card transition duration-300 hover:border-brand-pink dark:border-white/10 dark:bg-slate-900">
				<div class="flex items-start gap-4">
					<div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-brand-mist text-brand-pink dark:bg-white/5">
						<svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 8.25h16.5M7.5 3.75h9a3.75 3.75 0 013.75 3.75v9A3.75 3.75 0 0116.5 20.25h-9a3.75 3.75 0 01-3.75-3.75v-9A3.75 3.75 0 017.5 3.75zm3 7.5h3" />
						</svg>
					</div>
					<div>
						<h4 class="text-lg font-bold text-brand-blue dark:text-white">{{ $ecografia->nombre }}</h4>
						<p class="mt-2 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $ecografia->descripcion }}</p>
					</div>
				</div>
			</article>
		@empty
			<p class="col-span-full rounded-[1.75rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">No hay ecografias disponibles.</p>
		@endforelse
	</div>
</section>