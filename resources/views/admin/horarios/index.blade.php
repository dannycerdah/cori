@extends('layouts.app')

@section('title', 'Horarios — Clínica CORI')
@section('description', 'Gestión de horarios de atención por servicio y doctor.')
@section('robots', 'noindex, nofollow')

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <x-admin-nav />

    <div class="mb-8">
        <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
            <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Panel administrativo</span>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Horarios</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Define las franjas de atención por servicio, doctor y días de la semana.</p>
    </div>

    @livewire('admin.horarios-manager')
</section>
@endsection
