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
	$ctaBaseClasses = 'inline-flex items-center justify-center rounded-full px-7 py-3.5 text-sm font-semibold tracking-[0.01em] transition duration-200 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-brand-blue sm:min-w-[190px]';
	$ctaPrimaryClasses = 'bg-gradient-to-r from-white via-brand-mist to-white text-brand-blue shadow-[0_14px_34px_rgba(15,23,42,0.18)] ring-1 ring-white/70 hover:from-brand-mist hover:to-white hover:shadow-[0_18px_40px_rgba(15,23,42,0.24)] focus-visible:ring-white dark:from-brand-pink dark:via-brand-blue dark:to-brand-dark dark:text-white dark:ring-white/15 dark:shadow-[0_14px_34px_rgba(8,15,40,0.45)] dark:hover:from-brand-blue dark:hover:via-brand-pink dark:hover:to-brand-dark dark:hover:shadow-[0_18px_40px_rgba(8,15,40,0.55)] dark:focus-visible:ring-brand-mist dark:focus-visible:ring-offset-slate-950';
	$ctaSecondaryClasses = $ctaPrimaryClasses;
@endphp

<section class="relative isolate overflow-hidden">
	<div class="absolute inset-0 bg-brand-light dark:bg-slate-950"></div>
	<div class="absolute inset-x-0 top-0 h-[50rem] bg-gradient-to-br from-brand-blue via-brand-blue/90 to-brand-pink sm:h-[54rem] lg:h-[50rem]"></div>
	<div class="absolute right-[-5rem] top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
	<div class="absolute left-[-4rem] top-40 h-56 w-56 rounded-full bg-brand-pink/30 blur-3xl"></div>

	<div class="relative mx-auto grid min-h-[62vh] w-full max-w-7xl items-start gap-8 px-4 pb-16 pt-4 sm:px-6 sm:pb-20 sm:pt-6 lg:min-h-[68vh] lg:grid-cols-[1.05fr_0.95fr] lg:gap-10 lg:px-8 lg:pb-16 lg:pt-6 xl:min-h-[72vh]">
		<div class="flex flex-col justify-start text-white">
			<div class="inline-flex w-fit items-center gap-3 rounded-full border border-white/15 bg-white/10 px-5 py-2 text-sm font-semibold uppercase tracking-[0.28em] backdrop-blur">
				<span class="h-2.5 w-2.5 rounded-full bg-brand-pink"></span>
				Salud confiable
			</div>

			<h1 class="mt-8 max-w-3xl text-balance text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">{{ $heroTitle }}</h1>
			<p class="mt-6 max-w-2xl text-lg leading-8 text-white/82 md:text-xl">{{ $heroSubtitle }}</p>

			<div class="mt-10 flex flex-col gap-4 sm:flex-row">
				<a href="{{ route($primaryButtonRoute) }}" class="{{ $ctaBaseClasses }} {{ $ctaPrimaryClasses }}">
					{{ $primaryButtonText }}
				</a>
				<a href="{{ url('/#servicios') }}" class="{{ $ctaBaseClasses }} {{ $ctaSecondaryClasses }}">
					Ver servicios
				</a>
			</div>

			<div class="mt-10 grid gap-4 sm:grid-cols-3">
				<div class="rounded-2xl border border-brand-blue/25 border-l-8 border-l-brand-pink bg-gradient-to-b from-white to-brand-soft/70 p-5 shadow-[0_16px_34px_rgba(15,23,42,0.14)] backdrop-blur-md dark:border-white/20 dark:border-l-brand-pink dark:bg-gradient-to-b dark:from-slate-900/82 dark:to-slate-800/72 dark:shadow-[0_14px_30px_rgba(2,6,23,0.45)]">
					<p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-700 dark:text-brand-mist">Actividad</p>
					<p class="mt-2 text-3xl font-extrabold leading-none text-brand-blue dark:text-white">+6k</p>
					<p class="mt-2 text-sm font-semibold text-slate-700 dark:text-slate-200">consultas atendidas</p>
				</div>
				<div class="rounded-2xl border border-brand-blue/25 border-l-8 border-l-brand-blue bg-gradient-to-b from-white to-brand-soft/70 p-5 shadow-[0_16px_34px_rgba(15,23,42,0.14)] backdrop-blur-md dark:border-white/20 dark:border-l-brand-blue dark:bg-gradient-to-b dark:from-slate-900/82 dark:to-slate-800/72 dark:shadow-[0_14px_30px_rgba(2,6,23,0.45)]">
					<p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-700 dark:text-brand-mist">Equipo</p>
					<p class="mt-2 text-3xl font-extrabold leading-none text-brand-blue dark:text-white">12</p>
					<p class="mt-2 text-sm font-semibold text-slate-700 dark:text-slate-200">especialistas activos</p>
				</div>
				<div class="rounded-2xl border border-brand-blue/25 border-l-8 border-l-emerald-500 bg-gradient-to-b from-white to-brand-soft/70 p-5 shadow-[0_16px_34px_rgba(15,23,42,0.14)] backdrop-blur-md dark:border-white/20 dark:border-l-emerald-400 dark:bg-gradient-to-b dark:from-slate-900/82 dark:to-slate-800/72 dark:shadow-[0_14px_30px_rgba(2,6,23,0.45)]">
					<p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-700 dark:text-brand-mist">Calidad</p>
					<p class="mt-2 text-3xl font-extrabold leading-none text-brand-blue dark:text-white">4.9/5</p>
					<p class="mt-2 text-sm font-semibold text-slate-700 dark:text-slate-200">valoracion promedio</p>
				</div>
			</div>
		</div>

		<div class="flex w-full self-start items-start justify-center lg:justify-end">
			<div class="glass-panel relative w-full max-w-lg overflow-hidden rounded-[2rem] border border-white/20 p-5 shadow-glow md:p-6 dark:border-white/10">
				<div class="absolute inset-x-8 top-0 h-24 bg-gradient-to-b from-white/30 to-transparent"></div>
				<div class="relative aspect-[3/4] w-full overflow-hidden rounded-[1.6rem] md:aspect-[4/5]">
					<img src="{{ $heroImage }}" alt="Clinica CORI" class="h-full w-full object-cover object-center shadow-card">
				</div>
				<div class="absolute bottom-7 left-7 right-7 rounded-[1.5rem] border border-white/25 bg-brand-blue/75 p-5 text-white backdrop-blur-xl md:bottom-9 md:left-9 md:right-9">
					<p class="text-sm font-semibold uppercase tracking-[0.24em] text-brand-mist">Clinica CORI</p>
					<p class="mt-2 text-xl font-bold">Cuidado profesional, experiencia cercana e interfaz moderna.</p>
					<p class="mt-2 text-sm leading-6 text-white/75">Paleta azul y rosa, animaciones suaves y acciones simples enfocadas en conversion.</p>
				</div>
			</div>
		</div>
	</div>
</section>