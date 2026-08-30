<!DOCTYPE html>
<html lang="es" x-data="siteShell()" x-bind:class="{ 'dark': darkMode }" x-cloak>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@php
		$pageTitle = trim($__env->yieldContent('title')) ?: 'Clínica CORI — Atención médica moderna y confiable';
		$pageDescription = trim($__env->yieldContent('description')) ?: 'Clínica CORI ofrece atención médica moderna, cercana y confiable, con especialidades médicas, ecografías, cirugías y reserva de citas en línea.';
		$pageImage = asset('images/HERO.png');
	@endphp
	<title>{{ $pageTitle }}</title>
	<meta name="description" content="{{ $pageDescription }}">
	<meta name="robots" content="@yield('robots', 'index, follow')">
	<link rel="canonical" href="{{ url()->current() }}">
	<link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
	<link rel="alternate icon" href="{{ asset('images/favicon.svg') }}">

	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Clínica CORI">
	<meta property="og:locale" content="es_PE">
	<meta property="og:title" content="{{ $pageTitle }}">
	<meta property="og:description" content="{{ $pageDescription }}">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:image" content="{{ $pageImage }}">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $pageTitle }}">
	<meta name="twitter:description" content="{{ $pageDescription }}">
	<meta name="twitter:image" content="{{ $pageImage }}">

	<script>
		(() => {
			const storedTheme = localStorage.getItem('cori-theme');
			const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
			if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
				document.documentElement.classList.add('dark');
			}
		})();
	</script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<script>
		function siteShell() {
			return {
				darkMode: document.documentElement.classList.contains('dark'),
				mobileMenuOpen: false,
				scrolled: false,
				activeSection: 'inicio',

				init() {
					// Sticky header scroll-aware background
					const onScroll = () => { this.scrolled = window.scrollY > 24; };
					window.addEventListener('scroll', onScroll, { passive: true });
					onScroll();

					// Active section highlighting via IntersectionObserver
					const sections = document.querySelectorAll(
						'#inicio, #servicios, #nosotros, #doctores, #contacto'
					);
					if (sections.length) {
						const obs = new IntersectionObserver((entries) => {
							entries.forEach(e => { if (e.isIntersecting) this.activeSection = e.target.id; });
						}, { threshold: 0.3, rootMargin: '-80px 0px -40% 0px' });
						sections.forEach(el => obs.observe(el));
					}
				},

				toggleTheme() {
					this.darkMode = !this.darkMode;
					document.documentElement.classList.toggle('dark', this.darkMode);
					localStorage.setItem('cori-theme', this.darkMode ? 'dark' : 'light');
				}
			};
		}
	</script>
	@livewireStyles
</head>
<body class="min-h-screen text-slate-900 transition-colors duration-300 dark:text-slate-100">
	<div class="relative isolate overflow-hidden">
		<div class="absolute inset-x-0 top-0 -z-10 h-[32rem] bg-gradient-to-b from-white/55 to-transparent dark:from-white/5"></div>

		<header
			:class="scrolled
				? 'bg-white/95 shadow-[0_4px_24px_rgba(46,47,127,0.10)] border-b border-slate-200/70 dark:bg-slate-950/95 dark:border-white/10'
				: 'bg-white/75 border-b border-white/40 dark:bg-slate-950/60 dark:border-white/10'"
			class="sticky top-0 z-50 backdrop-blur-xl transition-all duration-300"
		>
			<div class="mx-auto flex h-[72px] w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

				{{-- Logo --}}
				<a href="{{ route('home') }}" class="group flex items-center rounded-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2">
					<img src="{{ asset('images/logo-cori.svg') }}" alt="Clínica CORI" class="h-10 w-auto max-w-[150px] transition-transform duration-300 group-hover:scale-[1.02] sm:h-11 sm:max-w-[170px]">
				</a>

				{{-- Desktop navigation --}}
				<nav class="hidden items-center gap-1 md:flex" aria-label="Navegación principal">
					<a href="{{ route('home') }}#inicio"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='inicio' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Inicio</a>
					<a href="{{ route('home') }}#servicios"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='servicios' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Servicios</a>
					<a href="{{ route('nosotros') }}"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='nosotros' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Nosotros</a>
					<a href="{{ route('home') }}#doctores"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='doctores' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Doctores</a>
					<a href="{{ route('home') }}#contacto"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='contacto' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Contacto</a>
				</nav>

				{{-- Actions --}}
				<div class="flex items-center gap-2">

					{{-- Admin login (desktop) --}}
					<a
						href="{{ route('login') }}"
						class="hidden items-center justify-center rounded-xl border border-slate-200/80 bg-white/60 p-2.5 text-slate-500 backdrop-blur-sm transition-all duration-200 hover:border-brand-pink/50 hover:bg-brand-mist hover:text-brand-pink dark:border-white/10 dark:bg-white/5 dark:text-slate-400 dark:hover:border-brand-pink/50 dark:hover:text-brand-pink md:inline-flex"
						aria-label="Acceso administrativo"
						title="Acceso administrativo"
					>
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A3.75 3.75 0 0012 1.5a3.75 3.75 0 00-3.75 3.75V9m-2.25 0h12a2.25 2.25 0 012.25 2.25v8.25a2.25 2.25 0 01-2.25 2.25h-12a2.25 2.25 0 01-2.25-2.25v-8.25A2.25 2.25 0 016 9z" />
						</svg>
					</a>

					{{-- Dark mode toggle (desktop) --}}
					<button
						type="button"
						@click="toggleTheme()"
						class="hidden items-center justify-center rounded-xl border border-slate-200/80 bg-white/60 p-2.5 text-slate-500 backdrop-blur-sm transition-all duration-200 hover:border-brand-pink/50 hover:bg-brand-mist hover:text-brand-pink dark:border-white/10 dark:bg-white/5 dark:text-slate-400 dark:hover:border-brand-pink/50 dark:hover:text-brand-pink md:inline-flex"
						aria-label="Alternar tema"
					>
						<svg x-show="!darkMode" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25M12 18.75V21M4.72 4.72l1.59 1.59M17.69 17.69l1.59 1.59M3 12h2.25M18.75 12H21M4.72 19.28l1.59-1.59M17.69 6.31l1.59-1.59M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
						</svg>
						<svg x-show="darkMode" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A9 9 0 1111.21 3c0 .35.02.7.05 1.05A7 7 0 0020 12c.34.03.7.05 1 .79z" />
						</svg>
					</button>

					{{-- CTA button (desktop) --}}
					<a
						href="{{ route('citas') }}"
						class="hidden items-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-2.5 text-[15px] font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_26px_rgba(230,62,140,0.45)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2 md:inline-flex"
					>
						<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
						</svg>
						Reservar cita
					</a>

					{{-- Hamburger (mobile) --}}
					<button
						type="button"
						@click="mobileMenuOpen = !mobileMenuOpen"
						class="inline-flex items-center justify-center rounded-xl border border-slate-200/80 bg-white/70 p-2.5 text-slate-600 transition-colors duration-200 hover:border-brand-pink/40 hover:text-brand-pink dark:border-white/10 dark:bg-white/5 dark:text-slate-300 md:hidden"
						:aria-expanded="mobileMenuOpen.toString()"
						aria-label="Abrir menú"
					>
						<svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						</svg>
						<svg x-show="mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>
			</div>

			{{-- Mobile menu --}}
			<div
				x-show="mobileMenuOpen"
				x-transition:enter="transition ease-out duration-200"
				x-transition:enter-start="opacity-0 -translate-y-2"
				x-transition:enter-end="opacity-100 translate-y-0"
				x-transition:leave="transition ease-in duration-150"
				x-transition:leave-start="opacity-100 translate-y-0"
				x-transition:leave-end="opacity-0 -translate-y-2"
				class="overflow-hidden border-t border-slate-200/60 bg-white/95 px-4 py-4 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/95 md:hidden"
			>
				<nav class="flex flex-col gap-1" aria-label="Menú móvil">
					<a href="{{ route('home') }}#inicio"    @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Inicio
					</a>
					<a href="{{ route('home') }}#servicios" @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Servicios
					</a>
					<a href="{{ route('nosotros') }}"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Nosotros
					</a>
					<a href="{{ route('home') }}#doctores"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Doctores
					</a>
					<a href="{{ route('home') }}#contacto"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Contacto
					</a>
					<a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="mt-2 flex items-center gap-3 rounded-xl border-t border-slate-200/60 px-4 pb-1 pt-4 text-sm font-medium text-slate-500 transition-colors hover:text-brand-pink dark:border-white/10 dark:text-slate-400">
						<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 9V5.25A3.75 3.75 0 0012 1.5a3.75 3.75 0 00-3.75 3.75V9m-2.25 0h12a2.25 2.25 0 012.25 2.25v8.25a2.25 2.25 0 01-2.25 2.25h-12a2.25 2.25 0 01-2.25-2.25v-8.25A2.25 2.25 0 016 9z" />
						</svg>
						Acceso administrativo
					</a>
				</nav>
				<div class="mt-3 flex items-center justify-between gap-3 border-t border-slate-200/60 pt-3 dark:border-white/10">
					<a
						href="{{ route('citas') }}"
						@click="mobileMenuOpen = false"
						class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-5 py-3 text-sm font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.3)]"
					>
						<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
						</svg>
						Reservar cita
					</a>
					<button
						type="button"
						@click="toggleTheme()"
						class="shrink-0 rounded-xl border border-slate-200/80 bg-white/60 p-3 text-slate-500 transition-colors hover:border-brand-pink/50 hover:text-brand-pink dark:border-white/10 dark:bg-white/5 dark:text-slate-400"
						aria-label="Alternar tema"
					>
						<svg x-show="!darkMode" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25M12 18.75V21M4.72 4.72l1.59 1.59M17.69 17.69l1.59 1.59M3 12h2.25M18.75 12H21M4.72 19.28l1.59-1.59M17.69 6.31l1.59-1.59M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
						</svg>
						<svg x-show="darkMode" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A9 9 0 1111.21 3c0 .35.02.7.05 1.05A7 7 0 0020 12c.34.03.7.05 1 .79z" />
						</svg>
					</button>
				</div>
			</div>
		</header>

		<main>
			@yield('content')
		</main>

		@unless(request()->is('login') || request()->is('admin/*'))
			<section class="mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex flex-col items-center gap-6 rounded-[2rem] bg-gradient-to-r from-brand-blue to-brand-pink px-8 py-12 text-center text-white shadow-glow sm:flex-row sm:justify-between sm:px-12 sm:text-left">
					<div>
						<p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">¿Lista para tu próxima consulta?</p>
						<h2 class="mt-3 text-2xl font-extrabold sm:text-3xl">Agenda tu cita en minutos</h2>
					</div>
					<a href="{{ route('citas') }}" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-blue shadow-lg transition hover:-translate-y-0.5">
						<svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
						</svg>
						Reservar cita
					</a>
				</div>
			</section>
		@endunless

		@php
			$footerContact = \App\Models\ContentSection::whereIn('key', ['contact_phone', 'contact_email'])->where('active', true)->get()->keyBy('key');
			$footerPhone = $footerContact['contact_phone']->contenido ?? '+56 9 1234 5678';
			$footerEmail = $footerContact['contact_email']->contenido ?? 'contacto@clinicacori.com';
			$whatsappNumber = '51964278433';
			$whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode('Hola, quisiera más información sobre Clínica CORI.');
		@endphp

		<footer class="mt-16 border-t border-white/50 bg-white/70 py-12 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/75">
			<div class="mx-auto grid w-full max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1.4fr_1fr_1fr] lg:px-8">
				<div>
					<img src="{{ asset('images/logo-cori.svg') }}" alt="Clínica CORI" class="h-14 w-auto sm:h-16">
					<p class="mt-5 max-w-md text-sm leading-7 text-slate-600 dark:text-slate-300">Atención médica moderna, cercana y confiable. Diseñamos una experiencia clara para que cada paciente se sienta acompañada desde el primer contacto.</p>
				</div>

				<div>
					<h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-blue dark:text-brand-pink">Enlaces</h3>
					<div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
						<a href="{{ route('home') }}#servicios" class="block transition hover:text-brand-pink">Servicios</a>
						<a href="{{ route('home') }}#doctores" class="block transition hover:text-brand-pink">Doctores</a>
						<a href="{{ route('citas') }}" class="block transition hover:text-brand-pink">Reservar cita</a>
						<a href="{{ route('contacto') }}" class="block transition hover:text-brand-pink">Contacto</a>
					</div>
				</div>

				<div>
					<h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-blue dark:text-brand-pink">Redes</h3>
					<div class="mt-4 flex gap-3">
						<a href="https://facebook.com" target="_blank" rel="noreferrer" class="rounded-full border border-slate-200 p-3 text-slate-600 transition hover:border-brand-pink hover:text-brand-pink dark:border-white/10 dark:text-slate-300">
							<span class="sr-only">Facebook</span>
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 21v-7h2.3l.5-3h-2.8V9.2c0-.8.3-1.6 1.7-1.6H16V5.1c-.3 0-1-.1-1.9-.1-2 0-3.3 1.2-3.3 3.4V11H8.5v3h2.3v7h2.7z" /></svg>
						</a>
						<a href="https://instagram.com" target="_blank" rel="noreferrer" class="rounded-full border border-slate-200 p-3 text-slate-600 transition hover:border-brand-pink hover:text-brand-pink dark:border-white/10 dark:text-slate-300">
							<span class="sr-only">Instagram</span>
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7.5 3h9A4.5 4.5 0 0121 7.5v9a4.5 4.5 0 01-4.5 4.5h-9A4.5 4.5 0 013 16.5v-9A4.5 4.5 0 017.5 3zm0 1.8A2.7 2.7 0 004.8 7.5v9a2.7 2.7 0 002.7 2.7h9a2.7 2.7 0 002.7-2.7v-9a2.7 2.7 0 00-2.7-2.7h-9zm9.75 1.35a.9.9 0 110 1.8.9.9 0 010-1.8zM12 7.8A4.2 4.2 0 1112 16.2 4.2 4.2 0 0112 7.8zm0 1.8a2.4 2.4 0 100 4.8 2.4 2.4 0 000-4.8z" /></svg>
						</a>
						<a href="https://linkedin.com" target="_blank" rel="noreferrer" class="rounded-full border border-slate-200 p-3 text-slate-600 transition hover:border-brand-pink hover:text-brand-pink dark:border-white/10 dark:text-slate-300">
							<span class="sr-only">LinkedIn</span>
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.94 8.5H4V20h2.94V8.5zM5.47 4A1.72 1.72 0 103.75 5.72 1.72 1.72 0 005.47 4zM20 12.78C20 9.92 18.48 8.3 16.08 8.3a3.52 3.52 0 00-3.2 1.76V8.5H9.94c.04 1.02 0 11.5 0 11.5h2.94v-6.42c0-.34.02-.69.13-.93a1.93 1.93 0 011.81-1.29c1.28 0 1.79.98 1.79 2.41V20H20v-7.22z" /></svg>
						</a>
						<a href="{{ $whatsappUrl }}" target="_blank" rel="noreferrer" class="rounded-full border border-slate-200 p-3 text-slate-600 transition hover:border-[#25D366] hover:text-[#25D366] dark:border-white/10 dark:text-slate-300">
							<span class="sr-only">WhatsApp</span>
							<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.05 2C6.514 2 2.03 6.48 2.03 12.01c0 1.762.463 3.484 1.34 4.994L2 22l5.146-1.35a10.03 10.03 0 004.904 1.25h.004c5.535 0 10.02-4.48 10.02-10.01A9.98 9.98 0 0012.05 2zm0 18.15h-.003a8.13 8.13 0 01-4.14-1.135l-.297-.176-3.056.802.816-2.98-.194-.306a8.1 8.1 0 01-1.246-4.348c0-4.483 3.653-8.13 8.146-8.13a8.09 8.09 0 015.751 2.38 8.07 8.07 0 012.386 5.75c0 4.482-3.653 8.148-8.163 8.148z"/></svg>
						</a>
					</div>
					<div class="mt-6 space-y-2.5 text-sm text-slate-600 dark:text-slate-300">
						<a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="flex items-center gap-2.5 transition hover:text-brand-pink">
							<svg class="h-4 w-4 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
							{{ $footerPhone }}
						</a>
						<a href="mailto:{{ $footerEmail }}" class="flex items-center gap-2.5 transition hover:text-brand-pink">
							<svg class="h-4 w-4 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
							{{ $footerEmail }}
						</a>
						<p class="flex items-center gap-2.5">
							<svg class="h-4 w-4 shrink-0 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
							Lunes a viernes, 8:00 a. m. - 7:00 p. m.
						</p>
					</div>
				</div>
			</div>

			<div class="mx-auto mt-10 flex w-full max-w-7xl flex-col items-center justify-center gap-3 border-t border-slate-200/70 px-4 pt-6 text-sm text-slate-500 dark:border-white/10 dark:text-slate-400 sm:flex-row sm:justify-between sm:px-6 lg:px-8">
				<p>&copy; {{ date('Y') }} Clínica CORI. Todos los derechos reservados.</p>
				<p>Diseñado para transmitir confianza, claridad y cuidado moderno.</p>
				<a href="{{ route('login') }}" class="text-slate-400 transition hover:text-brand-pink dark:text-slate-500">Acceso administrativo</a>
			</div>
		</footer>
	</div>

	@unless(request()->is('login') || request()->is('admin/*'))
		<a
			href="{{ $whatsappUrl }}"
			target="_blank"
			rel="noreferrer"
			class="fixed bottom-6 right-6 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-[0_10px_30px_rgba(37,211,102,0.45)] transition duration-200 hover:-translate-y-1 hover:shadow-[0_14px_36px_rgba(37,211,102,0.55)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#25D366]"
			aria-label="Escríbenos por WhatsApp"
		>
			<svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.05 2C6.514 2 2.03 6.48 2.03 12.01c0 1.762.463 3.484 1.34 4.994L2 22l5.146-1.35a10.03 10.03 0 004.904 1.25h.004c5.535 0 10.02-4.48 10.02-10.01A9.98 9.98 0 0012.05 2zm0 18.15h-.003a8.13 8.13 0 01-4.14-1.135l-.297-.176-3.056.802.816-2.98-.194-.306a8.1 8.1 0 01-1.246-4.348c0-4.483 3.653-8.13 8.146-8.13a8.09 8.09 0 015.751 2.38 8.07 8.07 0 012.386 5.75c0 4.482-3.653 8.148-8.163 8.148z"/></svg>
		</a>
	@endunless

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const restoreRaw = sessionStorage.getItem('cori-scroll-restore');
			if (restoreRaw) {
				try {
					const restore = JSON.parse(restoreRaw);
					if (restore && restore.path === window.location.pathname && Number.isFinite(restore.y)) {
						window.scrollTo({ top: restore.y, behavior: 'auto' });
					}
				} catch (e) {
					// Ignore invalid payload and continue normally.
				}
				sessionStorage.removeItem('cori-scroll-restore');
			}

			if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				document.querySelectorAll('.section-reveal').forEach((element) => element.classList.add('is-visible'));
				return;
			}

			// threshold bajo: algunas secciones (ej. Servicios) son mas altas que el viewport,
			// por lo que un threshold alto nunca llega a cumplirse y el contenido queda oculto.
			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						observer.unobserve(entry.target);
					}
				});
			}, { threshold: 0, rootMargin: '0px 0px -10% 0px' });

			const revealElements = document.querySelectorAll('.section-reveal');
			revealElements.forEach((element) => observer.observe(element));

			// Salvaguarda: si por algun motivo el observer no revela un elemento, no debe
			// quedar invisible de forma permanente.
			window.setTimeout(() => {
				revealElements.forEach((element) => element.classList.add('is-visible'));
			}, 4000);
		});
	</script>

	@livewireScripts
</body>
</html>