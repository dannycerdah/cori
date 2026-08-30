@extends('layouts.app')

@section('title', 'Bloqueos de horario — Clínica CORI')
@section('description', 'Gestión de bloqueos de agenda de los doctores.')
@section('robots', 'noindex, nofollow')

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <x-admin-nav />

    <div class="mb-8">
        <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
            <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Panel administrativo</span>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Bloqueos de horario</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Registra ausencias o periodos en los que un doctor no atiende.</p>
    </div>

    @livewire('admin.bloqueos-manager')
</section>
@endsection
