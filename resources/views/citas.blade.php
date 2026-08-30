@extends('layouts.app')

@section('title', 'Reserva tu cita médica — Clínica CORI')
@section('description', 'Agenda tu cita médica en Clínica CORI en minutos: elige especialidad, fecha y hora. Confirmación rápida y datos protegidos.')

@section('content')
    <div class="section-reveal">
        @livewire(\App\Livewire\CitaForm::class)
    </div>
@endsection