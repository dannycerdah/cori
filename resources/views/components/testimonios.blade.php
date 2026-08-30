@php
	$testimonials = [
		[
			'quote' => 'La experiencia fue impecable. El equipo nos explicó cada paso con claridad y nos sentimos acompañados en todo momento.',
			'author' => 'Valeria P.',
			'role' => 'Paciente de medicina preventiva',
		],
		[
			'quote' => 'Reservar la cita fue rápido y la atención del personal médico transmitió mucha seguridad y profesionalismo.',
			'author' => 'Jorge M.',
			'role' => 'Paciente de cardiología',
		],
		[
			'quote' => 'Clínica CORI combina tecnología con trato humano. La comunicación posterior a la consulta también fue excelente.',
			'author' => 'Carolina S.',
			'role' => 'Paciente de laboratorio clinico',
		],
	];
@endphp

<section class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="mx-auto max-w-3xl text-center">
		<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Testimonios</p>
		<h2 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-5xl">Confianza construida con atención clara y resultados consistentes</h2>
	</div>

	<div class="mt-14 grid gap-6 lg:grid-cols-3">
		@foreach ($testimonials as $testimonial)
			<article class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900">
				<div class="flex gap-1 text-brand-pink">
					@for ($i = 0; $i < 5; $i++)
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" /></svg>
					@endfor
				</div>
				<p class="mt-6 text-base leading-8 text-slate-600 dark:text-slate-300">"{{ $testimonial['quote'] }}"</p>
				<div class="mt-8 border-t border-slate-100 pt-5 dark:border-white/10">
					<p class="font-semibold text-brand-blue dark:text-white">{{ $testimonial['author'] }}</p>
					<p class="text-sm text-slate-500 dark:text-slate-400">{{ $testimonial['role'] }}</p>
				</div>
			</article>
		@endforeach
	</div>
</section>