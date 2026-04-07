@php
	$fallbackHeroPath = '/images/hero.png';
	$rawHeroImage = $hero->image_url ?? $fallbackHeroPath;

	if (!str_starts_with($rawHeroImage, 'http')) {
		$normalizedPath = '/' . ltrim($rawHeroImage, '/');
		$publicImagePath = public_path(ltrim($normalizedPath, '/'));
		$rawHeroImage = file_exists($publicImagePath) ? $normalizedPath : $fallbackHeroPath;
		$heroImage = asset(ltrim($rawHeroImage, '/'));
	} else {
		$heroImage = $rawHeroImage;
	}

	$heroTitle = $hero->title ?? 'Atencion moderna con la calidez y confianza que cada paciente espera';
	$heroSubtitle = $hero->subtitle ?? 'Clinica CORI brinda atencion medica confiable con una experiencia digital clara, especialistas modernos y reserva adaptable.';
	$primaryButtonText = $hero->button_text ?? 'Reservar cita';
	$primaryButtonRoute = $hero->button_url ?? 'citas';
@endphp

<section class="relative isolate overflow-hidden">
	<div class="absolute inset-0 bg-brand-light dark:bg-slate-950"></div>
	<div class="absolute inset-x-0 top-0 h-[42rem] bg-gradient-to-br from-brand-blue via-brand-blue/90 to-brand-pink"></div>
	<div class="absolute right-[-5rem] top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
	<div class="absolute left-[-4rem] top-40 h-56 w-56 rounded-full bg-brand-pink/30 blur-3xl"></div>

	<div class="relative mx-auto grid min-h-[84vh] w-full max-w-7xl gap-10 px-4 pb-24 pt-16 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pb-28 lg:pt-20">
		<div class="flex flex-col justify-center text-white">
			<div class="inline-flex w-fit items-center gap-3 rounded-full border border-white/15 bg-white/10 px-5 py-2 text-sm font-semibold uppercase tracking-[0.28em] backdrop-blur">
				<span class="h-2.5 w-2.5 rounded-full bg-brand-pink"></span>
				Salud confiable
			</div>

			<h1 class="mt-8 max-w-3xl text-balance text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">{{ $heroTitle }}</h1>
			<p class="mt-6 max-w-2xl text-lg leading-8 text-white/82 md:text-xl">{{ $heroSubtitle }}</p>

			<div class="mt-10 flex flex-col gap-4 sm:flex-row">
				<a href="{{ route($primaryButtonRoute) }}" class="inline-flex items-center justify-center rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-blue shadow-glow transition hover:-translate-y-0.5 hover:bg-brand-mist">
					{{ $primaryButtonText }}
				</a>
				<a href="{{ url('/#servicios') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-white/15">
					Ver servicios
				</a>
			</div>

			<div class="mt-12 grid gap-4 sm:grid-cols-3">
				<div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4 backdrop-blur">
					<p class="text-2xl font-bold">+6k</p>
					<p class="mt-1 text-sm text-white/72">consultas atendidas</p>
				</div>
				<div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4 backdrop-blur">
					<p class="text-2xl font-bold">12</p>
					<p class="mt-1 text-sm text-white/72">especialistas activos</p>
				</div>
				<div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4 backdrop-blur">
					<p class="text-2xl font-bold">4.9/5</p>
					<p class="mt-1 text-sm text-white/72">valoracion promedio</p>
				</div>
			</div>
		</div>

		<div class="flex items-center justify-center lg:justify-end">
			<div class="glass-panel relative w-full max-w-xl overflow-hidden rounded-[2rem] border border-white/20 p-4 shadow-glow dark:border-white/10">
				<div class="absolute inset-x-8 top-0 h-24 bg-gradient-to-b from-white/30 to-transparent"></div>
				<img src="{{ $heroImage }}" alt="Clinica CORI" class="h-[29rem] w-full rounded-[1.6rem] object-cover object-center shadow-card md:h-[34rem]">
				<div class="absolute bottom-9 left-9 right-9 rounded-[1.5rem] border border-white/25 bg-brand-blue/75 p-5 text-white backdrop-blur-xl">
					<p class="text-sm font-semibold uppercase tracking-[0.24em] text-brand-mist">Clinica CORI</p>
					<p class="mt-2 text-xl font-bold">Cuidado profesional, experiencia cercana e interfaz moderna.</p>
					<p class="mt-2 text-sm leading-6 text-white/75">Paleta azul y rosa, animaciones suaves y acciones simples enfocadas en conversion.</p>
				</div>
			</div>
		</div>
	</div>
</section>