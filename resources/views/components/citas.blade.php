<section id="citas" class="section-reveal mx-auto mt-24 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="grid gap-8 lg:grid-cols-[0.92fr_1.08fr] lg:items-start">
		<div class="rounded-[2rem] bg-white p-8 shadow-card dark:bg-slate-900 md:p-10">
			<p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand-pink">Reserva de citas</p>
			<h2 class="mt-4 text-3xl font-extrabold text-brand-blue dark:text-white md:text-4xl">Reserva tu cita en minutos</h2>
			<p class="mt-5 text-base leading-8 text-slate-600 dark:text-slate-300">El formulario se mantiene simple: datos esenciales, especialidad, fecha y hora. Eso reduce fricción y mejora la conversión en dispositivos móviles.</p>
			<div class="mt-8 grid gap-4 sm:grid-cols-2">
				<div class="rounded-2xl bg-brand-light p-5 dark:bg-white/5">
					<p class="text-sm font-semibold text-brand-blue dark:text-white">Respuesta rápida</p>
					<p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Confirmación clara y seguimiento posterior al registro.</p>
				</div>
				<div class="rounded-2xl bg-brand-light p-5 dark:bg-white/5">
					<p class="text-sm font-semibold text-brand-blue dark:text-white">Primero en móvil</p>
					<p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Campos amplios, alto contraste y acciones visibles.</p>
				</div>
			</div>
		</div>

		<div class="cori-panel rounded-[2rem] p-3 shadow-card md:p-4">
			@livewire(\App\Http\Livewire\CitaForm::class)
		</div>
	</div>
</section>