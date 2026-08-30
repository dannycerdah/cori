@php
	$address = $contact['contact_address']->contenido ?? 'Av. Carlos Izaguirre 978, Los Olivos';
	$reference = $contact['contact_reference']->contenido ?? 'Frente a la zona comercial principal';
	$phone = $contact['contact_phone']->contenido ?? '+56 9 1234 5678';
	$email = $contact['contact_email']->contenido ?? 'contacto@clinicacori.com';
	$mapQuery = urlencode($address);
@endphp

<section class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr]">
	<div class="rounded-[2rem] bg-gradient-to-br from-brand-blue to-brand-dark p-8 text-white shadow-glow md:p-10">
		<p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-mist">Contáctanos</p>
		<h2 class="mt-4 text-3xl font-extrabold md:text-4xl">Sección de contacto pensada para transmitir confianza y acción rápida</h2>
		<p class="mt-5 max-w-xl text-base leading-8 text-white/82">Incluimos teléfono, email, dirección y un mapa integrado para que la ruta de contacto sea directa desde escritorio o móvil.</p>

		<div class="mt-10 space-y-5">
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Teléfono</p>
				<a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="mt-2 block text-lg font-semibold text-white">{{ $phone }}</a>
			</div>
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Correo</p>
				<a href="mailto:{{ $email }}" class="mt-2 block text-lg font-semibold text-white">{{ $email }}</a>
			</div>
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Dirección</p>
				<p class="mt-2 text-lg font-semibold">{{ $address }}</p>
				<p class="mt-2 text-sm text-white/75">{{ $reference }}</p>
			</div>
		</div>
	</div>

	<div class="grid gap-6">
		<div class="relative overflow-hidden rounded-[2rem] bg-white shadow-card dark:bg-slate-900" x-data="{ mapLoaded: false }">
			<div
				x-show="!mapLoaded"
				x-transition:leave="transition ease-in duration-300"
				x-transition:leave-end="opacity-0"
				class="absolute inset-0 flex h-80 w-full animate-pulse items-center justify-center bg-slate-100 dark:bg-slate-800"
			>
				<svg class="h-10 w-10 text-slate-300 dark:text-slate-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
					<path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
				</svg>
			</div>
			<iframe
				src="https://www.google.com/maps?q={{ $mapQuery }}&output=embed"
				class="relative h-80 w-full border-0"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				@load="mapLoaded = true"
			></iframe>
		</div>

		<div class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900">
			<h3 class="text-2xl font-bold text-brand-blue dark:text-white">Reservar cita</h3>
			<p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">Un CTA visible con bordes redondeados y colores de marca mantiene coherencia visual y facilita la conversión.</p>
			<div class="mt-6 flex flex-col gap-4 sm:flex-row">
				<a href="{{ route('citas') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-brand-blue to-brand-pink px-6 py-3 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-0.5">Reservar cita</a>
				<a href="https://www.google.com/maps?q={{ $mapQuery }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-brand-pink hover:text-brand-pink dark:border-white/10 dark:text-slate-200">Abrir mapa</a>
			</div>
		</div>
	</div>
</section>