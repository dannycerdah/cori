@extends('layouts.app')

@section('title', 'Contacto — Clínica CORI')
@section('description', 'Ubicación, teléfono, correo y mapa de Clínica CORI. Escríbenos o agenda tu cita médica en pocos pasos.')

@section('content')
	<section class="mx-auto w-full max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
		<div class="section-reveal mb-10 max-w-3xl">
			<p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-pink">Página de contacto</p>
			<h1 class="mt-4 text-4xl font-extrabold text-brand-blue dark:text-white md:text-5xl">Conecta con Clínica CORI en pocos pasos</h1>
			<p class="mt-5 text-lg leading-8 text-slate-600 dark:text-slate-300">Diseño adaptable, información esencial visible y mapa integrado para una experiencia de contacto más directa y profesional.</p>
		</div>

		<div class="section-reveal">
			<livewire:contact />
		</div>
	</section>
@endsection