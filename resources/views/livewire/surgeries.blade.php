<section>
	<div class="flex items-end justify-between gap-4">
		<div>
			<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-pink">Procedures</p>
			<h3 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white md:text-3xl">Procedimientos y cirugias</h3>
		</div>
		<p class="hidden max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300 md:block">La interfaz presenta informacion compleja en tarjetas simples, con contraste suave y microinteracciones discretas.</p>
	</div>

	<div class="mt-8 grid gap-6 md:grid-cols-2">
		@forelse($surgeries as $surgery)
			<article class="rounded-[1.75rem] bg-white p-6 shadow-card transition duration-300 hover:shadow-glow dark:bg-slate-900">
				<div class="flex items-start gap-4">
					<div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-brand-soft text-brand-blue dark:bg-white/5 dark:text-brand-pink">
						<svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7.5 4.5h9m-7.5 4.5h6m-8.25 4.5h10.5m-9 4.5h7.5" />
						</svg>
					</div>
					<div>
						<h4 class="text-lg font-bold text-brand-blue dark:text-white">{{ $surgery->nombre }}</h4>
						<p class="mt-2 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $surgery->descripcion }}</p>
					</div>
				</div>
			</article>
		@empty
			<p class="col-span-full rounded-[1.75rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">No hay procedimientos disponibles.</p>
		@endforelse
	</div>
</section>