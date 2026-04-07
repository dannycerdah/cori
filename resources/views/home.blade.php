@extends('layouts.app')

@section('content')
	@php
		$clinicHighlights = [
			['value' => '15+', 'label' => 'anos de experiencia'],
			['value' => '24/7', 'label' => 'acompanamiento digital'],
			['value' => '98%', 'label' => 'pacientes satisfechos'],
		];

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

		$testimonials = [
			[
				'quote' => 'La experiencia fue impecable. El equipo nos explico cada paso con claridad y nos sentimos acompanados en todo momento.',
				'author' => 'Valeria P.',
				'role' => 'Paciente de medicina preventiva',
			],
			[
				'quote' => 'Reservar la cita fue rapido y la atencion del personal medico transmitio mucha seguridad y profesionalismo.',
				'author' => 'Jorge M.',
				'role' => 'Paciente de cardiologia',
			],
			[
				'quote' => 'Clinica CORI combina tecnologia con trato humano. La comunicacion posterior a la consulta tambien fue excelente.',
				'author' => 'Carolina S.',
				'role' => 'Paciente de laboratorio clinico',
			],
		];
	@endphp

	<div class="pb-16">
		<section id="inicio">
			<livewire:hero />
		</section>

		<section class="section-reveal mx-auto -mt-14 w-full max-w-6xl px-4 sm:px-6 lg:px-8">
			<div class="glass-panel grid gap-6 rounded-[2rem] border border-white/70 p-6 shadow-card dark:border-white/10 md:grid-cols-3 md:p-8">
				@foreach ($clinicHighlights as $highlight)
					<div class="rounded-[1.5rem] bg-white/75 p-6 text-center dark:bg-white/5">
						<p class="text-3xl font-extrabold text-brand-blue dark:text-white">{{ $highlight['value'] }}</p>
						<p class="mt-2 text-sm font-medium text-slate-600 dark:text-slate-300">{{ $highlight['label'] }}</p>
					</div>
				@endforeach
			</div>
		</section>

		<section id="servicios" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="mx-auto max-w-3xl text-center">
				<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Servicios medicos</p>
				<h2 class="mt-4 text-balance text-3xl font-extrabold text-brand-blue dark:text-white md:text-5xl">Atencion integral con un diseno limpio, humano y profesional</h2>
				<p class="mt-5 text-lg leading-8 text-slate-600 dark:text-slate-300">Organizamos los servicios clave de Clinica CORI en bloques claros para que el paciente encuentre rapidamente lo que necesita.</p>
			</div>

			<div class="mt-14 space-y-16">
				<livewire:services />
				<livewire:ecografias />
				<livewire:surgeries />
				<livewire:especialidades />
			</div>
		</section>

		<section id="nosotros" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-stretch">
				<div class="rounded-[2rem] bg-gradient-to-br from-brand-blue via-brand-blue to-brand-dark p-8 text-white shadow-glow md:p-12">
					<p class="text-sm font-semibold uppercase tracking-[0.28em] text-brand-mist">Sobre la clinica</p>
					<h2 class="mt-4 text-3xl font-extrabold md:text-5xl">Clinica CORI ofrece una experiencia medica confiable desde el primer clic.</h2>
					<p class="mt-6 max-w-2xl text-base leading-8 text-white/82 md:text-lg">Combinamos protocolos medicos actualizados, procesos digitales simples y una comunicacion cercana para que pacientes y familias se sientan guiados en todo momento.</p>
					<div class="mt-10 grid gap-4 sm:grid-cols-2">
						<div class="rounded-[1.5rem] border border-white/15 bg-white/10 p-5">
							<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Mision</p>
							<p class="mt-3 text-sm leading-7 text-white/82">Brindar atencion segura, empatica y eficiente mediante equipos medicos especializados y tecnologia accesible.</p>
						</div>
						<div class="rounded-[1.5rem] border border-white/15 bg-white/10 p-5">
							<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Vision</p>
							<p class="mt-3 text-sm leading-7 text-white/82">Ser una clinica referente por su experiencia digital, calidez humana y resultados clinicos consistentes.</p>
						</div>
					</div>
				</div>

				<div class="grid gap-6">
					<div class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900">
						<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-pink">Por que elegirnos</p>
						<ul class="mt-6 space-y-4 text-sm leading-7 text-slate-600 dark:text-slate-300">
							<li class="rounded-2xl bg-brand-light px-5 py-4 dark:bg-white/5">Flujo de reserva simple y accesible desde cualquier dispositivo.</li>
							<li class="rounded-2xl bg-brand-light px-5 py-4 dark:bg-white/5">Equipos medicos con experiencia en atencion preventiva y especializada.</li>
							<li class="rounded-2xl bg-brand-light px-5 py-4 dark:bg-white/5">Instalaciones modernas con enfoque en tranquilidad, higiene y confort.</li>
						</ul>
					</div>

					<div class="rounded-[2rem] bg-gradient-to-br from-brand-mist to-white p-8 shadow-card dark:from-brand-blue/20 dark:to-slate-900">
						<p class="text-sm font-semibold uppercase tracking-[0.26em] text-brand-blue dark:text-brand-pink">Tagline</p>
						<h3 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white">Un diseno sanitario que se siente cercano, claro y confiable.</h3>
						<p class="mt-4 text-sm leading-7 text-slate-600 dark:text-slate-300">El sitio prioriza claridad visual, espacios amplios, microanimaciones suaves y llamadas a la accion visibles para mejorar conversion y confianza.</p>
					</div>
				</div>
			</div>
		</section>

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

		<section id="citas" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr] lg:items-start">
				<div class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900 md:p-10">
					<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Reserva de citas</p>
					<h2 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Reserva tu cita en minutos</h2>
					<p class="mt-5 text-base leading-8 text-slate-600 dark:text-slate-300">El formulario se mantiene simple: datos esenciales, especialidad, fecha y hora. Eso reduce friccion y mejora la conversion en dispositivos moviles.</p>
					<div class="mt-8 grid gap-4 sm:grid-cols-2">
						<div class="rounded-2xl bg-brand-light p-5 dark:bg-white/5">
							<p class="text-sm font-semibold text-brand-blue dark:text-white">Respuesta rapida</p>
							<p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Confirmacion clara y seguimiento posterior al registro.</p>
						</div>
						<div class="rounded-2xl bg-brand-light p-5 dark:bg-white/5">
							<p class="text-sm font-semibold text-brand-blue dark:text-white">Primero en movil</p>
							<p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Campos amplios, alto contraste y acciones visibles.</p>
						</div>
					</div>
				</div>

				<div class="cori-panel rounded-[2rem] p-3 shadow-card md:p-4">
					@livewire(\App\Http\Livewire\CitaForm::class)
				</div>
			</div>
		</section>

		<section class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="mx-auto max-w-3xl text-center">
				<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Testimonios</p>
				<h2 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-5xl">Confianza construida con atencion clara y resultados consistentes</h2>
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

		<section id="contacto" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<livewire:contact />
		</section>
	</div>
@endsection