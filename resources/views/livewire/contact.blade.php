<section class="rounded-2xl bg-white border border-slate-100 p-8 md:p-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Contact Info -->
        <div class="space-y-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-text-dark mb-2">Contáctenos</h2>
                <p class="text-text-muted">Estamos aquí para responder tus preguntas y agendar tu consulta.</p>
            </div>

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-brand-light">
                            <svg class="h-5 w-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-text-dark">Teléfono</h3>
                        <p class="text-text-muted">+56 9 1234 5678</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-brand-light">
                            <svg class="h-5 w-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-text-dark">Email</h3>
                        <p class="text-text-muted">contacto@clinicacori.com</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-brand-light">
                            <svg class="h-5 w-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-text-dark">Dirección</h3>
                        <p class="text-text-muted">Calle Falsa 123, Santiago</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-brand-light">
                            <svg class="h-5 w-5 text-brand-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-text-dark">Horarios</h3>
                        <p class="text-text-muted text-sm">Lunes a Viernes: 8:00 - 18:00</p>
                        <p class="text-text-muted text-sm">Sábados: 9:00 - 14:00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Box -->
        <div class="bg-brand-light rounded-xl p-8 flex flex-col justify-center">
            <h3 class="text-2xl font-bold text-text-dark mb-3">¿Listo para tu cita?</h3>
            <p class="text-text-muted mb-6 leading-relaxed">
Agenda tu consulta con nuestros especialistas. Nos complace brindar atención de calidad y un acompañamiento cercano en cada paso de tu cuidado.
            </p>
            <a href="{{ route('citas') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold text-white bg-brand-rose hover:bg-red-700 transition duration-200 shadow-sm hover:shadow-md">
                Registrar Cita
            </a>
        </div>
    </div>
</section>
