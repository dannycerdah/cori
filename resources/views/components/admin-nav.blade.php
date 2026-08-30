@php
    // Pestañas del panel administrativo. 'match' = prefijo de nombre de ruta para marcar activa.
    $tabs = [
        ['label' => 'Citas', 'route' => 'admin.citas.index', 'match' => 'admin.citas.'],
        ['label' => 'Pacientes', 'route' => 'admin.pacientes.index', 'match' => 'admin.pacientes.'],
        ['label' => 'Especialidades', 'route' => 'admin.especialidades.index', 'match' => 'admin.especialidades.'],
        ['label' => 'Servicios', 'route' => 'admin.servicios.index', 'match' => 'admin.servicios.'],
        ['label' => 'Doctores', 'route' => 'admin.doctores.index', 'match' => 'admin.doctores.'],
        ['label' => 'Horarios', 'route' => 'admin.horarios.index', 'match' => 'admin.horarios.'],
        ['label' => 'Bloqueos', 'route' => 'admin.bloqueos.index', 'match' => 'admin.bloqueos.'],
    ];
@endphp

<nav class="mb-8 flex flex-wrap items-center gap-2 rounded-2xl border border-slate-100 bg-white/70 p-2 shadow-sm dark:border-white/10 dark:bg-slate-900/70" aria-label="Navegación del panel">
    @foreach ($tabs as $tab)
        <a
            href="{{ route($tab['route']) }}"
            @class([
                'rounded-xl px-4 py-2 text-sm font-semibold transition',
                'bg-gradient-to-r from-brand-blue to-brand-pink text-white shadow-[0_4px_14px_rgba(230,62,140,0.35)]' => request()->routeIs($tab['match'].'*'),
                'text-slate-500 hover:bg-brand-soft hover:text-brand-blue dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white' => ! request()->routeIs($tab['match'].'*'),
            ])
        >
            {{ $tab['label'] }}
        </a>
    @endforeach

    <form method="POST" action="{{ route('logout') }}" class="ml-auto">
        @csrf
        <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-500 transition hover:border-rose-300 hover:text-rose-600 dark:border-white/10 dark:text-slate-400 dark:hover:border-rose-400/40 dark:hover:text-rose-300">
            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H2.25" />
            </svg>
            Cerrar sesión
        </button>
    </form>
</nav>
