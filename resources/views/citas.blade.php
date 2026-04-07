@extends('layouts.app')

@section('content')
    <section class="mx-auto w-full max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
            <div class="section-reveal rounded-[2rem] bg-gradient-to-br from-brand-blue to-brand-dark p-8 text-white shadow-glow md:p-10">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-mist">Reservar cita</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight">Reserva una cita con Clinica CORI</h1>
                <p class="mt-5 text-base leading-8 text-white/82">Pagina enfocada en conversion con jerarquia visual clara, colores de marca y espaciado amplio para transmitir confianza.</p>

                <div class="mt-10 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Proceso simple</p>
                        <p class="mt-2 text-sm leading-7 text-white/82">Completa tus datos, elige especialidad y agenda tu horario.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Respuesta rapida</p>
                        <p class="mt-2 text-sm leading-7 text-white/82">Confirmacion rapida y seguimiento claro despues del envio.</p>
                    </div>
                </div>
            </div>

            <div class="cori-panel section-reveal rounded-[2rem] p-4 shadow-card md:p-5">
                @livewire(\App\Http\Livewire\CitaForm::class)
            </div>
        </div>
    </section>
@endsection