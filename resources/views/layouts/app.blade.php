<!DOCTYPE html>
<html lang="es" x-data="siteShell()" x-bind:class="{ 'dark': darkMode }" x-cloak>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title ?? 'Clinica CORI' }}</title>

	<script>
		(() => {
			const storedTheme = localStorage.getItem('cori-theme');
			const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
			if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
				document.documentElement.classList.add('dark');
			}
		})();
	</script>

	<script src="https://cdn.tailwindcss.com"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
	<script>
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					fontFamily: {
						sans: ['Inter', 'sans-serif'],
					},
					colors: {
						brand: {
							blue: '#2E2F7F',
							pink: '#E63E8C',
							light: '#F8F9FC',
							dark: '#15173F',
							soft: '#EEF1FF',
							mist: '#FFF0F7',
						},
					},
					boxShadow: {
						glow: '0 24px 70px rgba(46, 47, 127, 0.14)',
						card: '0 18px 45px rgba(46, 47, 127, 0.1)',
					},
				}
			}
		};

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
	<style>
		[x-cloak] { display: none !important; }

		*, *::before, *::after {
			box-sizing: border-box;
		}

		html,
		body {
			width: 100%;
			min-width: 0;
			overflow-x: hidden;
		}

		html {
			scroll-behavior: smooth;
		}

		body {
			font-family: 'Inter', sans-serif;
			background:
				radial-gradient(circle at top left, rgba(230, 62, 140, 0.08), transparent 28%),
				radial-gradient(circle at top right, rgba(46, 47, 127, 0.1), transparent 22%),
				#F8F9FC;
		}

		img,
		picture,
		svg,
		video,
		iframe {
			max-width: 100%;
			height: auto;
			display: block;
		}

		.glass-panel,
		.cori-panel {
			width: 100%;
			max-width: 100%;
			min-width: 0;
		}

		.dark body {
			background:
				radial-gradient(circle at top left, rgba(230, 62, 140, 0.08), transparent 28%),
				radial-gradient(circle at top right, rgba(118, 133, 255, 0.12), transparent 22%),
				#0D1027;
		}

		.section-reveal {
			opacity: 0;
			transform: translateY(24px);
			transition: opacity 0.7s ease, transform 0.7s ease;
		}

		.section-reveal.is-visible {
			opacity: 1;
			transform: translateY(0);
		}

		.glass-panel {
			background: rgba(255, 255, 255, 0.72);
			backdrop-filter: blur(16px);
			-webkit-backdrop-filter: blur(16px);
		}

		.dark .glass-panel {
			background: rgba(14, 18, 44, 0.7);
		}

		.text-balance {
			text-wrap: balance;
		}

		/* ── Nav underline animation ─────────────────────── */
		.nav-link-pill {
			position: relative;
		}
		.nav-link-pill::after {
			content: '';
			position: absolute;
			bottom: 2px;
			left: 50%;
			height: 2px;
			width: 0;
			transform: translateX(-50%);
			border-radius: 9999px;
			background: linear-gradient(90deg, #2E2F7F, #E63E8C);
			transition: width 0.25s ease;
		}
		.nav-link-pill:hover::after,
		.nav-link-pill.is-active::after {
			width: 62%;
		}

		/* ── Form field CSS variables (cambian con .dark en <html>) ── */
		:root {
			--fi-bg:          #f8fafc;
			--fi-bg-focus:    #ffffff;
			--fi-border:      #e2e8f0;
			--fi-color:       #0f172a;
			--fi-placeholder: #94a3b8;
			--fi-label:       #475569;
			--fi-scheme:      light;
			--fi-panel-bg:    #ffffff;
			--fi-panel-ring:  transparent;
		}
		html.dark {
			--fi-bg:          #1e293b;
			--fi-bg-focus:    #263348;
			--fi-border:      #475569;
			--fi-color:       #f1f5f9;
			--fi-placeholder: #64748b;
			--fi-label:       #cbd5e1;
			--fi-scheme:      dark;
			--fi-panel-bg:    #1e293b;
			--fi-panel-ring:  rgba(255,255,255,0.08);
		}

		/* ── Form panel (card wrapper + inner form container) ─── */
		.cori-panel {
			background-color: var(--fi-panel-bg) !important;
			outline: 1px solid var(--fi-panel-ring);
			transition: background-color 0.3s ease, outline-color 0.3s ease;
		}

		/* ── Form field system ─────────────────────────────────── */
		.cori-label {
			display: flex;
			align-items: center;
			gap: 0.375rem;
			margin-bottom: 0.5rem;
			font-size: 0.8125rem;
			font-weight: 600;
			color: var(--fi-label);
			letter-spacing: 0.01em;
			transition: color 0.3s ease;
		}

		.cori-input {
			width: 100%;
			border-radius: 0.875rem;
			border: 1.5px solid var(--fi-border);
			background-color: var(--fi-bg) !important;
			padding: 0.75rem 1rem;
			font-size: 0.875rem;
			line-height: 1.5;
			color: var(--fi-color) !important;
			color-scheme: var(--fi-scheme);
			outline: none;
			transition: border-color 0.2s ease, box-shadow 0.2s ease,
			            background-color 0.3s ease, color 0.3s ease;
		}
		.cori-input::placeholder {
			color: var(--fi-placeholder) !important;
			opacity: 1;
		}
		.cori-input:focus {
			border-color: #E63E8C;
			background-color: var(--fi-bg-focus) !important;
			box-shadow: 0 0 0 3px rgba(230, 62, 140, 0.18),
			            0 0 0 1px rgba(230, 62, 140, 0.35);
		}
		.cori-input option {
			background-color: var(--fi-bg);
			color: var(--fi-color);
		}
		.cori-error {
			display: block;
			margin-top: 0.375rem;
			font-size: 0.75rem;
			color: #E63E8C;
			font-weight: 500;
		}

		@media (prefers-reduced-motion: reduce) {
			html {
				scroll-behavior: auto;
			}

			.section-reveal {
				opacity: 1;
				transform: none;
				transition: none;
			}
		}
	</style>

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
					<img src="{{ asset('images/logo-cori.svg') }}" alt="Clinica CORI" class="h-10 w-auto max-w-[150px] transition-transform duration-300 group-hover:scale-[1.02] sm:h-11 sm:max-w-[170px]">
				</a>

				{{-- Desktop navigation --}}
				<nav class="hidden items-center gap-1 md:flex" aria-label="Navegación principal">
					<a href="{{ route('home') }}#inicio"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='inicio' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Inicio</a>
					<a href="{{ route('home') }}#servicios"
					   class="nav-link-pill relative rounded-xl px-4 py-2.5 text-[15px] font-semibold transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink"
					   :class="activeSection==='servicios' ? 'text-brand-blue dark:text-white is-active' : 'text-slate-500 hover:text-brand-blue dark:text-slate-400 dark:hover:text-white'">Servicios</a>
					<a href="{{ route('home') }}#nosotros"
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
					<a href="{{ route('home') }}#nosotros"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Nosotros
					</a>
					<a href="{{ route('home') }}#doctores"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Doctores
					</a>
					<a href="{{ route('home') }}#contacto"  @click="mobileMenuOpen = false" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 transition-colors hover:bg-brand-soft hover:text-brand-blue dark:text-slate-200 dark:hover:bg-white/5 dark:hover:text-white">
						<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-pink"></span>Contacto
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

		<footer class="mt-24 border-t border-white/50 bg-white/70 py-12 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/75">
			<div class="mx-auto grid w-full max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[1.4fr_1fr_1fr] lg:px-8">
				<div>
					<img src="{{ asset('images/logo-cori.svg') }}" alt="Clinica CORI" class="h-14 w-auto sm:h-16">
					<p class="mt-5 max-w-md text-sm leading-7 text-slate-600 dark:text-slate-300">Atencion medica moderna, cercana y confiable. Disenamos una experiencia clara para que cada paciente se sienta acompanada desde el primer contacto.</p>
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
					</div>
					<p class="mt-5 text-sm text-slate-600 dark:text-slate-300">Lunes a viernes, 8:00 a. m. - 7:00 p. m.</p>
				</div>
			</div>

			<div class="mx-auto mt-10 flex w-full max-w-7xl flex-col items-center justify-between gap-3 border-t border-slate-200/70 px-4 pt-6 text-sm text-slate-500 dark:border-white/10 dark:text-slate-400 sm:flex-row sm:px-6 lg:px-8">
				<p>&copy; {{ date('Y') }} Clinica CORI. Todos los derechos reservados.</p>
				<p>Disenado para transmitir confianza, claridad y cuidado moderno.</p>
			</div>
		</footer>
	</div>

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

			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						observer.unobserve(entry.target);
					}
				});
			}, { threshold: 0.18 });

			document.querySelectorAll('.section-reveal').forEach((element) => observer.observe(element));
		});
	</script>

	@livewireScripts
</body>
</html>