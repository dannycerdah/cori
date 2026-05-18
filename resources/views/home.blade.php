@extends('layouts.app')

@section('content')

	<div class="pb-16">
		<section id="inicio">
			<livewire:hero />
		</section>

		<section id="servicios" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			 

			<div class="mx-auto max-w-3xl text-center">
							
				<p class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-brand-pink bg-brand-pink/10 rounded-full">
					<span class="w-2 h-2 bg-brand-pink rounded-full"></span>
					Servicios medicos
				</p>

			<h2 class="mt-2 text-balance text-3xl font-extrabold text-brand-blue dark:text-white md:text-5xl">
				Atención integral con un diseño limpio, humano y profesional
			</h2>

			<p class="mt-2 text-lg leading-8 text-slate-600 dark:text-slate-300">
				Brindamos atención cálida y profesional, con servicios organizados y comunicación clara en cada etapa.
			</p>
		
			<p class="mt-3 flex items-center justify-center gap-2 text-sm font-semibold uppercase tracking-[0.3em] text-brand-pink">					
				<svg class="w-4 h-4 text-brand-pink" fill="currentColor" viewBox="0 0 20 20">
					<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z"/>
				</svg>
				<span>SERVICIOS PRINCIPALES</span>
			</p>

			</div>


			<div class="mt-14 space-y-16">
				<livewire:services />
				<livewire:ecografias />
				<livewire:surgeries />
				<livewire:especialidades />
			</div>
		</section>

		@include('components.nosotros')

		<!-- @include('components.doctores') -->

		@include('components.citas')

		<!-- @include('components.testimonios') -->

		<section id="contacto" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
			<livewire:contact />
		</section>
	</div>
@endsection