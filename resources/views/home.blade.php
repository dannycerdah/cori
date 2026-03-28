@extends('layouts.app')

@section('content')
	<div class="space-y-10 pb-12">
		<livewire:hero />

		<section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
			<div class="rounded-2xl bg-white p-8 shadow-lg">
				<h1 class="mb-4 text-center text-3xl font-bold text-primary-blue md:text-4xl">Sobre Clinica Cori</h1>
				<p class="mx-auto max-w-3xl text-center text-base text-slate-700 md:text-lg">
					Somos una clinica dedicada a brindar atencion medica de calidad para cada etapa del cuidado de la mujer.
				</p>
			</div>
		</section>

		<section id="servicios" class="space-y-10">
			<livewire:services />
			<livewire:ecografias />
			<livewire:surgeries />
			<livewire:especialidades />
		</section>

		<livewire:contact />
	</div>
@endsection
