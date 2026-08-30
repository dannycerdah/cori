@extends('layouts.app')

@section('title', 'Panel de citas — Clínica CORI')
@section('robots', 'noindex, nofollow')

@section('content')
<section class="mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <x-admin-nav />

    <div class="mb-8">
        <div class="inline-flex items-center gap-2 rounded-full bg-brand-mist px-3 py-1.5 dark:bg-brand-pink/10">
            <svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-pink">Panel administrativo</span>
        </div>
        <h1 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Gestión de citas</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Revisa, filtra y actualiza el estado de las citas registradas.</p>
    </div>

    @livewire('admin-citas')
</section>
@endsection