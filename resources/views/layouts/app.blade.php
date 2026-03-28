<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title ?? 'Clinica Cori' }}</title>

	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						'primary-blue': '#2E3192',
						'secondary-pink': '#E23D8F',
						'light-pink': '#F472B6',
						'bg-light': '#F5F7FA',
						'text-dark': '#1F2937'
					}
				}
			}
		}
	</script>

	@livewireStyles
</head>
<body class="min-h-screen bg-bg-light text-text-dark">
	<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
		<div class="mx-auto flex h-20 w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
			<a href="{{ route('home') }}" class="flex items-center gap-3">
				<img src="{{ asset('images/logo-cori.svg') }}" alt="Clinica Cori" class="h-12 w-auto" onerror="this.style.display='none'">
				<span class="text-xl font-bold text-primary-blue">Clinica Cori</span>
			</a>

			<nav class="hidden items-center gap-8 md:flex">
				<a href="{{ route('home') }}" class="font-medium text-slate-700 transition hover:text-secondary-pink">Inicio</a>
				<a href="{{ url('/#servicios') }}" class="font-medium text-slate-700 transition hover:text-secondary-pink">Servicios</a>
				<a href="{{ route('contacto') }}" class="font-medium text-slate-700 transition hover:text-secondary-pink">Contacto</a>
			</nav>

			<div class="flex items-center gap-3">
				<a href="{{ route('citas') }}" class="rounded-full bg-secondary-pink px-5 py-2.5 font-semibold text-white transition hover:bg-light-pink">Agendar Cita</a>
				@auth
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-secondary-pink hover:text-secondary-pink">Salir</button>
					</form>
				@else
					<a href="{{ route('login') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-secondary-pink hover:text-secondary-pink">Login</a>
				@endauth
			</div>
		</div>
	</header>

	<main>
		@yield('content')
	</main>

	<footer class="mt-12 border-t border-slate-200 bg-white">
		<div class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 text-sm text-slate-600 sm:flex-row sm:px-6 lg:px-8">
			<p>© {{ date('Y') }} Clinica Cori. Todos los derechos reservados.</p>
			<p>Atencion medica con calidez y excelencia.</p>
		</div>
	</footer>

	@livewireScripts
</body>
</html>
