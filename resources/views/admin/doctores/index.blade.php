@extends('layouts.app')

@section('title', 'Doctores — Clínica CORI')
@section('description', 'Gestión del personal médico de Clínica CORI.')
@section('robots', 'noindex, nofollow')

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <x-admin-nav />

    <div class="mb-8">
        <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
            <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Panel administrativo</span>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Doctores</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Administra los doctores y las especialidades que atienden.</p>
    </div>

    @livewire('admin.doctores-manager')
</section>
@endsection
