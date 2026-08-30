@extends('layouts.app')

@section('title', 'Ingreso administrativo — Clínica CORI')
@section('robots', 'noindex, nofollow')

@section('content')
<section class="mx-auto flex min-h-[65vh] w-full max-w-7xl items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
	<div class="w-full max-w-md">
		<div class="cori-panel rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900 sm:p-10">
			<div class="mb-8 flex flex-col items-center text-center">
				<span class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-blue to-brand-pink text-white shadow-glow">
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
						<path fill-rule="evenodd" d="M10 1a4 4 0 00-4 4v2H5a1 1 0 00-1 1v9a2 2 0 002 2h8a2 2 0 002-2V8a1 1 0 00-1-1h-1V5a4 4 0 00-4-4zm2 6V5a2 2 0 10-4 0v2h4z" clip-rule="evenodd" />
					</svg>
				</span>
				<p class="text-xs font-semibold uppercase tracking-[0.3em] text-brand-pink">Acceso interno</p>
				<h1 class="mt-2 text-2xl font-bold text-brand-blue dark:text-white">Ingreso administrativo</h1>
				<p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Panel exclusivo para el equipo de Clínica CORI.</p>
			</div>

			<form method="POST" action="{{ route('login') }}" class="space-y-5">
				@csrf

				<div>
					<label class="cori-label" for="email">
						<svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
						Correo electrónico
					</label>
					<input id="email" type="email" name="email" value="{{ old('email') }}" class="cori-input" required autofocus autocomplete="email" placeholder="tucorreo@clinicacori.com" />
					@error('email') <span class="cori-error">{{ $message }}</span> @enderror
				</div>

				<div>
					<label class="cori-label" for="password">
						<svg class="h-3.5 w-3.5 shrink-0 text-brand-pink" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 1a4 4 0 00-4 4v2H5a1 1 0 00-1 1v9a2 2 0 002 2h8a2 2 0 002-2V8a1 1 0 00-1-1h-1V5a4 4 0 00-4-4zm2 6V5a2 2 0 10-4 0v2h4z" clip-rule="evenodd" /></svg>
						Contraseña
					</label>
					<input id="password" type="password" name="password" class="cori-input" required autocomplete="current-password" placeholder="••••••••" />
					@error('password') <span class="cori-error">{{ $message }}</span> @enderror
				</div>

				<button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-blue to-brand-pink px-6 py-3.5 text-[15px] font-semibold text-white shadow-[0_4px_18px_rgba(230,62,140,0.35)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_26px_rgba(230,62,140,0.45)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-pink focus-visible:ring-offset-2">
					Ingresar
				</button>
			</form>
		</div>
	</div>
</section>
@endsection
