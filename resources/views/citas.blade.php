@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
        <h1 class="text-4xl font-bold mb-4 text-center text-primary-blue">Registrar Cita Médica</h1>
        <p class="text-center mb-6 text-text-dark">Complete el formulario para agendar su cita médica de forma segura.</p>
    </div>

    @livewire('cita-form')
</div>
@endsection