@php
	$address = $contact['contact_address']->contenido ?? 'Av. Carlos Izaguirre 978, Los Olivos';
	$reference = $contact['contact_reference']->contenido ?? 'Frente a la zona comercial principal';
	$phone = $contact['contact_phone']->contenido ?? '+56 9 1234 5678';
	$email = $contact['contact_email']->contenido ?? 'contacto@clinicacori.com';
	$mapQuery = urlencode($address);
@endphp

<section class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr]">
	<div class="rounded-[2rem] bg-gradient-to-br from-brand-blue to-brand-dark p-8 text-white shadow-glow md:p-10">
		<p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-mist">Contactanos</p>
		<h2 class="mt-4 text-3xl font-extrabold md:text-4xl">Seccion de contacto pensada para transmitir confianza y accion rapida</h2>
		<p class="mt-5 max-w-xl text-base leading-8 text-white/82">Incluimos telefono, email, direccion y un mapa integrado para que la ruta de contacto sea directa desde escritorio o movil.</p>

		<div class="mt-10 space-y-5">
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Telefono</p>
				<a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="mt-2 block text-lg font-semibold text-white">{{ $phone }}</a>
			</div>
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Correo</p>
				<a href="mailto:{{ $email }}" class="mt-2 block text-lg font-semibold text-white">{{ $email }}</a>
			</div>
			<div class="rounded-[1.5rem] border border-white/12 bg-white/10 p-5 backdrop-blur">
				<p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-mist">Direccion</p>
				<p class="mt-2 text-lg font-semibold">{{ $address }}</p>
				<p class="mt-2 text-sm text-white/75">{{ $reference }}</p>
			</div>
		</div>
	</div>

	<div class="grid gap-6">
		<div class="overflow-hidden rounded-[2rem] bg-white shadow-card dark:bg-slate-900">
			<iframe src="https://www.google.com/maps?q={{ $mapQuery }}&output=embed" class="h-80 w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

		<div class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900">
			<h3 class="text-2xl font-bold text-brand-blue dark:text-white">Reservar cita</h3>
			<p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">Un CTA visible con bordes redondeados y colores de marca mantiene coherencia visual y facilita la conversion.</p>
			<div class="mt-6 flex flex-col gap-4 sm:flex-row">
				<a href="{{ route('citas') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-brand-blue to-brand-pink px-6 py-3 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-0.5">Reservar cita</a>
				<a href="https://www.google.com/maps?q={{ $mapQuery }}" target="_blank" rel="noreferrer" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-brand-pink hover:text-brand-pink dark:border-white/10 dark:text-slate-200">Abrir mapa</a>
			</div>
		</div>
	</div>
</section>