@extends('layouts.app')

@section('content')
	<div class="space-y-20 pb-20">
		<!-- Hero -->
		<livewire:hero />

		<!-- About Section -->
		<section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8 py-16">
			<div class="rounded-2xl bg-brand-light p-8 md:p-12">
				<h2 class="text-3xl md:text-4xl font-bold text-text-dark text-center mb-4">Sobre Clínica Cori</h2>
				<p class="mx-auto max-w-2xl text-center text-text-muted md:text-lg leading-relaxed">
					Somos una clínica dedicada a brindar atención médica de calidad para cada etapa del cuidado de la mujer. Con más de 15 años de experiencia, combinamos tecnología de punta con un acompañamiento humano genuino.
				</p>
			</div>
		</section>

		<!-- Services Section -->
		<section id="servicios" class="space-y-16 mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
			<livewire:services />
			<livewire:ecografias />
			<livewire:surgeries />
			<livewire:especialidades />
		</section>

		<!-- Contact Section -->
		<section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
			<livewire:contact />
		</section>
	</div>
@endsection
