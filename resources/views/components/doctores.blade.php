@php
	$doctorCards = [
		[
			'name' => 'Dra. Camila Rojas',
			'specialty' => 'Cardiologia clinica',
			'description' => 'Seguimiento preventivo y manejo integral para pacientes con factores de riesgo cardiovascular.',
			'gradient' => 'from-brand-blue to-sky-400',
			'initials' => 'CR',
		],
		[
			'name' => 'Dr. Mateo Castillo',
			'specialty' => 'Pediatria',
			'description' => 'Controles de crecimiento, vacunacion y acompanamiento cercano durante las primeras etapas.',
			'gradient' => 'from-brand-pink to-rose-300',
			'initials' => 'MC',
		],
		[
			'name' => 'Dra. Sofia Mendoza',
			'specialty' => 'Diagnostico y laboratorio',
			'description' => 'Procesos diagnosticos rapidos y precisos para acelerar decisiones medicas informadas.',
			'gradient' => 'from-indigo-500 to-brand-blue',
			'initials' => 'SM',
		],
	];
@endphp

<section id="doctores" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="mx-auto max-w-3xl text-center">
		<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Equipo medico</p>
		<h2 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-5xl">Doctores que combinan experiencia, tecnologia y acompanamiento humano</h2>
	</div>

	<div class="mt-14 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
		@foreach ($doctorCards as $doctor)
			<article class="group overflow-hidden rounded-[2rem] bg-white p-6 shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-glow dark:bg-slate-900">
				<div class="rounded-[1.75rem] bg-gradient-to-br {{ $doctor['gradient'] }} p-6 text-white">
					<div class="flex h-24 w-24 items-center justify-center rounded-[1.5rem] border border-white/25 bg-white/10 text-3xl font-extrabold backdrop-blur">{{ $doctor['initials'] }}</div>
					<p class="mt-6 text-sm font-semibold uppercase tracking-[0.24em] text-white/80">{{ $doctor['specialty'] }}</p>
					<h3 class="mt-2 text-2xl font-bold">{{ $doctor['name'] }}</h3>
				</div>
				<p class="mt-6 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $doctor['description'] }}</p>
				<div class="mt-6 flex items-center justify-between text-sm font-medium">
					<span class="rounded-full bg-brand-soft px-4 py-2 text-brand-blue dark:bg-white/5 dark:text-slate-200">Disponible esta semana</span>
					<a href="{{ route('citas') }}" class="text-brand-pink transition group-hover:text-brand-blue dark:group-hover:text-white">Agendar</a>
				</div>
			</article>
		@endforeach
	</div>
</section>