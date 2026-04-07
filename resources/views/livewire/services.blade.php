@php
	$serviceIcons = [
		'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 12.75l6 6 9-13.5" />',
		'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75l2.25 2.25L15 9.75M12 3.75a8.25 8.25 0 100 16.5 8.25 8.25 0 000-16.5z" />',
		'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 3v5.25L5.64 15.1a2.25 2.25 0 001.93 3.4h8.86a2.25 2.25 0 001.93-3.4l-4.11-6.85V3" />',
		'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s-6.75-4.35-6.75-10.13A4.88 4.88 0 0110.13 6 5.42 5.42 0 0112 7.2 5.42 5.42 0 0113.87 6a4.88 4.88 0 014.88 4.87C18.75 16.65 12 21 12 21z" />',
	];
@endphp

<section>
	<div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
		@forelse($services as $service)
			<article class="rounded-[1.75rem] bg-white p-6 shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow dark:bg-slate-900">
				<div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-soft text-brand-blue dark:bg-white/5 dark:text-brand-pink">
					<svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $serviceIcons[$loop->index % count($serviceIcons)] !!}</svg>
				</div>
				<h3 class="mt-6 text-xl font-bold text-brand-blue dark:text-white">{{ $service->nombre }}</h3>
				<p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $service->descripcion }}</p>
			</article>
		@empty
			<p class="col-span-full rounded-[1.75rem] bg-white px-6 py-8 text-center text-sm text-slate-500 shadow-card dark:bg-slate-900 dark:text-slate-300">No hay servicios disponibles por el momento.</p>
		@endforelse
	</div>
</section>