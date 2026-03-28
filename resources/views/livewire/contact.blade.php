<section class="bg-gradient-to-r from-primary-blue to-secondary-pink p-8 rounded-lg shadow-lg mx-4 text-white mb-8">
    <h2 class="text-3xl font-bold mb-8 text-center">Clínica Cori</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Ubicación -->
        <div class="bg-white/10 backdrop-blur-sm p-6 rounded-lg">
            <div class="flex items-start gap-3 mb-4">
                <span class="text-2xl">📍</span>
                <div>
                    <h3 class="text-xl font-bold mb-2">Ubicación</h3>
                    <a 
                        href="https://www.google.com/maps?q={{ urlencode($contact['contact_address']->contenido ?? 'Los Olivos Lima') }}" 
                        target="_blank" 
                        class="text-lg flex items-center gap-2 hover:underline hover:text-light-pink transition"
                    >
                        📍 {{ $contact['contact_address']->contenido ?? 'Los Olivos - Av. Carlos Izaguirre 978' }}
                    </a>
                </div>
            </div>        
                <!-- MAPA -->
            <div class="mt-4 rounded-lg overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps?q=Av.+Carlos+Izaguirre+978,+Los+Olivos,+Lima&output=embed"
                    width="100%" 
                    height="250" 
                    style="border:0;" 
                    loading="lazy">
                </iframe>
            </div>
                @if(isset($contact['contact_reference']))
                <div class="flex items-start gap-3">
                    <span class="text-2xl">📌</span>
                    <p class="text-lg">{{ $contact['contact_reference']->contenido }}</p>
                </div>
            @endif
        </div>

        <!-- Contacto WhatsApp -->
        <div class="bg-white/10 backdrop-blur-sm p-6 rounded-lg">
            <div class="flex items-start gap-3">
                <span class="text-2xl">📲</span>
                <div>
                    <h3 class="text-xl font-bold mb-2">WhatsApp</h3>
                    <div class="flex flex-col gap-2">
                        <a href="https://wa.me/51964278433" target="_blank" rel="noopener noreferrer" class="text-lg font-semibold hover:underline">964 278 433</a>
                        <a href="https://wa.me/51939220356" target="_blank" rel="noopener noreferrer" class="text-lg font-semibold hover:underline">939 220 356</a>
                    </div>
                    @if(isset($contact['contact_email']))
                        <p class="text-lg mt-3">Email: {{ $contact['contact_email']->contenido }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="text-center border-t border-white/30 pt-6">
        <p class="text-lg mb-4">¿Necesita una cita para su control de embarazo?</p>
        <p class="text-lg mb-6">Contáctenos para agendar su cita con nuestros especialistas.</p>
        <a href="{{ route('citas') }}" class="bg-white text-primary-blue font-bold py-3 px-8 rounded-full hover:bg-light-pink hover:text-white transition duration-300">Registrar Cita</a>
    </div>
</section>
