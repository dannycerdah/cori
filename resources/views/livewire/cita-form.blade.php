<div class="rounded-[1.75rem] bg-brand-light p-6 dark:bg-transparent md:p-8">
	<div class="mb-8 flex items-start justify-between gap-4">
		<div>
			<p class="text-sm font-semibold uppercase tracking-[0.24em] text-brand-pink">Formulario de reserva</p>
			<h2 class="mt-3 text-2xl font-bold text-brand-blue dark:text-white">Agenda tu visita medica</h2>
		</div>
		<div class="hidden rounded-2xl bg-white px-4 py-3 text-right shadow-sm dark:bg-white/5 sm:block">
			<p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Adaptable</p>
			<p class="mt-1 text-sm font-semibold text-brand-blue dark:text-white">Primero en movil</p>
		</div>
	</div>

	@if (session()->has('message'))
		<div class="mb-6 rounded-[1.25rem] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
			{{ session('message') }}
		</div>
	@endif

	<form wire:submit.prevent="reservar" class="space-y-6">
		<div class="grid gap-5 md:grid-cols-2">
			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Nombre del paciente</label>
				<input type="text" wire:model="paciente_nombre" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400" placeholder="Escribe tu nombre completo">
				@error('paciente_nombre') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Telefono</label>
				<input type="text" wire:model="telefono" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400" placeholder="Ej. +56 9 1234 5678">
				@error('telefono') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Email</label>
				<input type="email" wire:model="email" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400" placeholder="nombre@correo.com">
				@error('email') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Especialidad</label>
				<select wire:model="especialidad_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white">
					<option value="">Seleccione una especialidad</option>
					@foreach($especialidades as $especialidad)
						<option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
					@endforeach
				</select>
				@error('especialidad_id') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Fecha</label>
				<input type="date" wire:model="fecha" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white">
				@error('fecha') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div>
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Hora</label>
				<input type="time" wire:model="hora" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white">
				@error('hora') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>

			<div class="md:col-span-2">
				<label class="mb-2 block text-sm font-semibold text-brand-blue dark:text-white">Notas adicionales</label>
				<textarea wire:model="notas" rows="4" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand-pink focus:ring-4 focus:ring-brand-pink/10 dark:border-white/20 dark:bg-slate-800 dark:text-white dark:placeholder-slate-400" placeholder="Describe brevemente tu motivo de consulta"></textarea>
				@error('notas') <span class="mt-2 block text-sm text-brand-pink">{{ $message }}</span> @enderror
			</div>
		</div>

		<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
			<p class="text-sm leading-7 text-slate-600 dark:text-slate-300">Diseno con campos reutilizables, bordes suaves y foco visible para una experiencia clara.</p>
			<button type="submit" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-brand-blue to-brand-pink px-7 py-3.5 text-sm font-semibold text-white shadow-glow transition hover:-translate-y-0.5">
				Registrar cita
			</button>
		</div>
	</form>
</div>