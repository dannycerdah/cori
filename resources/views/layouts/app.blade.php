<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title ?? 'Clínica Cori' }}</title>

	<script src="https://cdn.tailwindcss.com"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<script>
		tailwind.config = {
			fontFamily: {
				sans: ['Inter', 'sans-serif'],
			},
			theme: {
				extend: {
					colors: {
						'brand-purple': '#6D28D9',
						'brand-rose': '#E11D48',
						'brand-light': '#F8FAFC',
						'text-dark': '#1F2937',
						'text-muted': '#6B7280',
					}
				},
				shadow: {
					'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
					'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
					'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
				}
			}
		}
	</script>

	@livewireStyles
</head>
<body class="min-h-screen bg-white text-text-dark" x-data="{ mobileMenuOpen: false }">
	<header class="sticky top-0 z-50 border-b border-slate-100 bg-white shadow-sm">
		<div class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
			<a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
				<div class="flex items-center justify-center w-10 h-10 rounded-xl bg-brand-purple">
					<span class="text-white font-bold text-lg">C</span>
				</div>
				<span class="hidden sm:block text-lg font-semibold text-text-dark">Clínica Cori</span>
			</a>

			<nav class="hidden items-center gap-8 md:flex">
				<a href="{{ route('home') }}" class="text-sm font-medium text-text-muted transition hover:text-brand-purple">Inicio</a>
				<a href="{{ url('/#servicios') }}" class="text-sm font-medium text-text-muted transition hover:text-brand-purple">Servicios</a>
				<a href="{{ route('contacto') }}" class="text-sm font-medium text-text-muted transition hover:text-brand-purple">Contacto</a>
			</nav>

			<div class="flex items-center gap-4">
				<a href="{{ route('citas') }}" class="hidden sm:inline-flex items-center justify-center px-6 py-2.5 rounded-xl font-semibold text-white bg-brand-rose hover:bg-red-700 transition duration-200 shadow-sm hover:shadow-md">
					Agendar Cita
				</a>
				
				<!-- Mobile menu button -->
				<button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-lg hover:bg-slate-100 text-text-dark">
					<svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
					</svg>
					<svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>

				@auth
					<form method="POST" action="{{ route('logout') }}" class="hidden md:inline">
						@csrf
						<button type="submit" class="text-sm font-medium text-text-muted hover:text-brand-purple transition">Salir</button>
					</form>
				@else
					<a href="{{ route('login') }}" class="hidden md:inline text-sm font-medium text-text-muted hover:text-brand-purple transition">Login</a>
				@endauth
			</div>
		</div>

		<!-- Mobile menu -->
		<div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" class="border-t border-slate-100 bg-white md:hidden">
			<div class="space-y-1 px-4 py-3">
				<a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-text-dark hover:bg-slate-50">Inicio</a>
				<a href="{{ url('/#servicios') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-text-dark hover:bg-slate-50">Servicios</a>
				<a href="{{ route('contacto') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-text-dark hover:bg-slate-50">Contacto</a>
				<a href="{{ route('citas') }}" class="block rounded-lg px-4 py-2 mt-2 text-sm font-semibold text-white bg-brand-rose hover:bg-red-700 transition text-center">Agendar Cita</a>
				@auth
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="w-full text-left block rounded-lg px-3 py-2 text-sm font-medium text-text-dark hover:bg-slate-50">Salir</button>
					</form>
				@else
					<a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-text-dark hover:bg-slate-50">Login</a>
				@endauth
			</div>
		</div>
	</header>

	<main>
		@yield('content')
	</main>

	<footer class="border-t border-slate-100 bg-slate-50">
		<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
				<div>
					<h3 class="font-semibold text-text-dark mb-4">Clínica Cori</h3>
					<p class="text-sm text-text-muted">Atención médica con calidez y excelencia para cada etapa del cuidado.</p>
				</div>
				<div>
					<h4 class="font-semibold text-text-dark mb-4 text-sm">Navegación</h4>
					<ul class="space-y-2 text-sm text-text-muted">
						<li><a href="{{ route('home') }}" class="hover:text-brand-purple transition">Inicio</a></li>
						<li><a href="{{ url('/#servicios') }}" class="hover:text-brand-purple transition">Servicios</a></li>
						<li><a href="{{ route('contacto') }}" class="hover:text-brand-purple transition">Contacto</a></li>
					</ul>
				</div>
				<div>
					<h4 class="font-semibold text-text-dark mb-4 text-sm">Contacto</h4>
					<ul class="space-y-2 text-sm text-text-muted">
						<li><a href="tel:+56912345678" class="hover:text-brand-purple transition">+56 9 1234 5678</a></li>
						<li><a href="mailto:contacto@clinicacori.com" class="hover:text-brand-purple transition">contacto@clinicacori.com</a></li>
					</ul>
				</div>
				<div>
					<a href="{{ route('citas') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg font-semibold text-white bg-brand-rose hover:bg-red-700 transition text-sm">
						Agendar Cita
					</a>
				</div>
			</div>
			<div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-text-muted">
				<p>© {{ date('Y') }} Clínica Cori. Todos los derechos reservados.</p>
			</div>
		</div>
	</footer>

	@livewireScripts
</body>
</html>
