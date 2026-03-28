@extends('layouts.app')

@section('content')
<section class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center text-primary-blue">Información de Contacto</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-4">
            <div class="flex items-center space-x-3">
                <div class="bg-secondary-pink p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-secondary-pink font-bold">Teléfono</h3>
                    <p class="text-text-dark">+56 9 1234 5678</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-secondary-pink p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-secondary-pink font-bold">Email</h3>
                    <p class="text-text-dark">contacto@clinicacori.com</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-secondary-pink p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-secondary-pink font-bold">Dirección</h3>
                    <p class="text-text-dark">Calle Falsa 123, Ciudad</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-secondary-pink p-3 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-secondary-pink font-bold">Horario</h3>
                    <p class="text-text-dark">Lunes a Viernes: 08:00 - 18:00</p>
                    <p class="text-text-dark">Sábados: 09:00 - 14:00</p>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-light-pink/20 to-secondary-pink/20 p-6 rounded-lg">
            <h3 class="text-primary-blue font-bold text-xl mb-4">¿Necesita ayuda?</h3>
            <p class="text-text-dark mb-4">Estamos aquí para atender sus consultas. No dude en contactarnos para cualquier pregunta sobre nuestros servicios.</p>
            <a href="{{ route('citas') }}" class="inline-block bg-secondary-pink hover:bg-light-pink text-white font-bold py-2 px-6 rounded-full transition duration-300">
                Agendar Cita
            </a>
        </div>
    </div>
</section>
@endsection