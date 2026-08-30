@extends('layouts.app')

@section('title', 'Panel de pacientes — Clínica CORI')
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
        <h1 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Pacientes registrados</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Consulta la información de contacto de los pacientes de la clínica.</p>
    </div>

    <div class="rounded-[2rem] bg-white p-6 shadow-card dark:bg-slate-900 sm:p-8">
        <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-white/10">
            <table class="min-w-full divide-y divide-slate-100 dark:divide-white/10">
                <thead class="bg-gradient-to-r from-brand-blue to-brand-pink text-white">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Documento</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Correo</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase tracking-wider">Nacimiento</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white dark:divide-white/10 dark:bg-slate-900">
                    @forelse ($pacientes as $paciente)
                        <tr class="transition hover:bg-brand-soft/50 dark:hover:bg-white/5">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-400 dark:text-slate-500">{{ $paciente->id }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ trim(($paciente->tipo_documento ? $paciente->tipo_documento.' ' : '').$paciente->numero_documento) ?: '—' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-brand-blue dark:text-white">{{ $paciente->nombre_completo }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $paciente->telefono ?? '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $paciente->correo ?? '—' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">{{ optional($paciente->fecha_nacimiento)->format('d/m/Y') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-400 dark:text-slate-500">No hay pacientes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pacientes->links() }}
        </div>
    </div>
</section>
@endsection
