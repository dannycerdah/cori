@php
	$fallbackHeroPath = '/images/hero.png';
	$rawHeroImage = $hero->image_url ?? $fallbackHeroPath;

	if (!str_starts_with($rawHeroImage, 'http')) {
		$normalizedPath = '/' . ltrim($rawHeroImage, '/');
		$publicImagePath = public_path(ltrim($normalizedPath, '/'));
		$rawHeroImage = file_exists($publicImagePath) ? $normalizedPath : $fallbackHeroPath;
		$heroImage = asset(ltrim($rawHeroImage, '/'));
	} else {
		$heroImage = $rawHeroImage;
	}

	$heroTitle = $hero->title ?? 'Atención médica especializada para tu bienestar';
	$heroSubtitle = $hero->subtitle ?? 'Atención integral, profesionales expertos y un acompañamiento cercano para cada etapa de tu cuidado.';
	$primaryButtonText = $hero->button_text ?? 'Agendar Cita';
	$primaryButtonRoute = $hero->button_url ?? 'citas';
@endphp

<div class="hero-wrapper">
	<section class="hero-modern relative isolate flex min-h-[70vh] items-center overflow-hidden text-white md:min-h-[80vh]" style="--hero-image: url('{{ $heroImage }}');">
		<div class="hero-modern__background absolute inset-0" aria-hidden="true"></div>
		<div class="hero-modern__overlay absolute inset-0" aria-hidden="true"></div>
		
		<div class="relative z-10 mx-auto w-full max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
			<div class="max-w-2xl">
				<p class="hero-modern__badge">Atención médica especializada</p>
				<h1 class="mt-6 text-4xl md:text-5xl lg:text-6xl font-bold leading-tight tracking-tight">
					{{ $heroTitle }}
				</h1>
				<p class="mt-6 text-lg md:text-xl leading-relaxed text-white/90">
					{{ $heroSubtitle }}
				</p>

				<div class="mt-8 flex flex-col gap-3 sm:flex-row">
					<a href="{{ route($primaryButtonRoute) }}" class="hero-modern__cta-primary inline-flex items-center justify-center px-8 py-3 rounded-xl font-semibold text-white transition duration-200 shadow-lg hover:shadow-xl">
						{{ $primaryButtonText }}
						<svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
						</svg>
					</a>
					<a href="{{ url('/#servicios') }}" class="hero-modern__cta-secondary inline-flex items-center justify-center px-8 py-3 rounded-xl font-semibold text-white border border-white/30 hover:bg-white/10 transition duration-200">
						Ver Servicios
					</a>
				</div>
			</div>
		</div>

		<!-- Scroll Indicator -->
		<div class="absolute bottom-8 left-1/2 z-20 -translate-x-1/2 animate-bounce">
			<svg class="h-6 w-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
			</svg>
		</div>
	</section>

@once
	<style>
		.hero-modern {
			margin-left: calc(50% - 50vw);
			margin-right: calc(50% - 50vw);
			background: linear-gradient(135deg, #1f2937 0%, #1e293b 100%);
		}

		.hero-modern__background {
			background-image: var(--hero-image);
			background-position: center 60%;
			background-repeat: no-repeat;
			background-size: cover;
			opacity: 0.3;
		}

		.hero-modern__overlay {
			background: linear-gradient(135deg, rgba(31, 41, 55, 0.85) 0%, rgba(30, 41, 59, 0.85) 50%, rgba(75, 85, 99, 0.4) 100%);
		}

		.hero-modern__badge {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			border-radius: 9999px;
			padding: 0.75rem 1.25rem;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: rgba(255, 255, 255, 0.9);
			font-size: 0.85rem;
			font-weight: 600;
			letter-spacing: 0.05em;
			text-transform: uppercase;
			backdrop-filter: blur(8px);
			animation: fadeInUp 0.8s ease-out;
		}

		.hero-modern__cta-primary {
			background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
			box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
			animation: fadeInUp 1s ease-out 0.1s both;
		}

		.hero-modern__cta-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 15px 35px rgba(220, 38, 38, 0.4);
		}

		.hero-modern__cta-secondary {
			background: rgba(255, 255, 255, 0.05);
			animation: fadeInUp 1s ease-out 0.2s both;
		}

		.hero-modern__cta-secondary:hover {
			background: rgba(255, 255, 255, 0.15);
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@media (max-width: 768px) {
			.hero-modern__background {
				opacity: 0.2;
			}
		}

		@media (prefers-reduced-motion: reduce) {
			.hero-modern__badge,
			.hero-modern__cta-primary,
			.hero-modern__cta-secondary,
			.animate-bounce {
				animation: none;
				transition: none;
			}
		}
	</style>
@endonce
</div>
