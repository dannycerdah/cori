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

	$heroTitle = $hero->title ?? 'Atencion medica especializada para tu bienestar';
	$heroSubtitle = $hero->subtitle ?? 'Atencion integral, profesionales expertos y un acompanamiento cercano para cada etapa de tu cuidado.';
	$primaryButtonText = $hero->button_text ?? 'Agendar Cita';
	$primaryButtonRoute = $hero->button_url ?? 'citas';
@endphp

<section class="hero-premium relative isolate flex min-h-[60vh] w-screen items-center overflow-hidden text-white md:min-h-[78vh] xl:min-h-[86vh]" style="--hero-image: url('{{ $heroImage }}');">
	<div class="hero-premium__image absolute inset-0" aria-hidden="true"></div>
	<div class="hero-premium__overlay absolute inset-0" aria-hidden="true"></div>
	<div class="hero-premium__glow hero-premium__glow--top absolute right-[8%] top-[12%] hidden h-52 w-52 rounded-full md:block" aria-hidden="true"></div>
	<div class="hero-premium__glow hero-premium__glow--bottom absolute bottom-[10%] right-[20%] hidden h-64 w-64 rounded-full md:block" aria-hidden="true"></div>

	<div class="relative z-10 mx-auto flex w-full max-w-7xl px-6 py-20 sm:px-8 md:px-10 lg:px-12">
		<div class="hero-premium__content max-w-3xl text-center md:text-left">
			<p class="hero-premium__eyebrow">Cuidado medico especializado</p>
			<h1 class="mt-5 text-4xl font-extrabold leading-[1.05] tracking-[-0.03em] text-white sm:text-5xl lg:text-[4rem] lg:leading-[0.98]">
				{{ $heroTitle }}
			</h1>
			<p class="mt-6 max-w-2xl text-lg font-medium leading-8 text-white/90 sm:text-xl md:text-[1.35rem] md:leading-9">
				{{ $heroSubtitle }}
			</p>
			<p class="mt-4 max-w-xl text-sm leading-7 text-white/72 sm:text-base md:text-lg">
				Agenda tu valoracion con un equipo que combina experiencia clinica, tecnologia y acompanamiento humano.
			</p>

			<div class="mt-10 flex flex-col items-center gap-4 sm:flex-row md:items-center md:justify-start">
				<a href="{{ route($primaryButtonRoute) }}" class="hero-premium__cta-primary inline-flex min-h-[3.75rem] items-center justify-center rounded-full px-8 py-4 text-base font-bold text-white shadow-lg shadow-secondary-pink/30 transition duration-300 sm:text-lg">
					{{ $primaryButtonText }}
				</a>
				<a href="{{ url('/#servicios') }}" class="hero-premium__cta-secondary inline-flex min-h-[3.75rem] items-center justify-center rounded-full border border-white/25 px-8 py-4 text-base font-semibold text-white/95 backdrop-blur-sm transition duration-300 sm:text-lg">
					Ver servicios
				</a>
			</div>
		</div>
	</div>
</section>

@once
	<style>
		.hero-premium {
			margin-left: calc(50% - 50vw);
			margin-right: calc(50% - 50vw);
			background: #0f172a;
		}

		.hero-premium__image {
			background-image: var(--hero-image);
			background-position: center 74%;
			background-repeat: no-repeat;
			background-size: cover;
			transform: scale(1.01);
			animation: heroImageZoom 10s ease-out forwards;
			will-change: transform;
		}

		.hero-premium__overlay {
			background:
				linear-gradient(90deg, rgba(8, 12, 26, 0.72) 0%, rgba(31, 23, 67, 0.58) 35%, rgba(92, 41, 111, 0.34) 66%, rgba(226, 61, 143, 0.12) 100%),
				linear-gradient(180deg, rgba(8, 13, 28, 0.16) 0%, rgba(8, 13, 28, 0.28) 100%);
		}

		.hero-premium__content {
			animation: heroContentFade 0.9s cubic-bezier(0.2, 0.8, 0.2, 1) both;
		}

		.hero-premium__eyebrow {
			display: inline-flex;
			align-items: center;
			gap: 0.65rem;
			border-radius: 9999px;
			padding: 0.55rem 1rem;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.16);
			color: rgba(255, 255, 255, 0.92);
			font-size: 0.78rem;
			font-weight: 700;
			letter-spacing: 0.22em;
			text-transform: uppercase;
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
		}

		.hero-premium__eyebrow::before {
			content: '';
			width: 0.55rem;
			height: 0.55rem;
			border-radius: 9999px;
			background: linear-gradient(135deg, #f472b6, #c026d3);
			box-shadow: 0 0 0 6px rgba(244, 114, 182, 0.18);
		}

		.hero-premium__cta-primary {
			background: linear-gradient(135deg, #e23d8f 0%, #c026d3 52%, #5b21b6 100%);
			box-shadow: 0 18px 40px rgba(194, 38, 211, 0.26);
		}

		.hero-premium__cta-primary:hover {
			transform: translateY(-2px) scale(1.02);
			box-shadow: 0 22px 48px rgba(194, 38, 211, 0.32);
		}

		.hero-premium__cta-secondary {
			background: rgba(255, 255, 255, 0.08);
			box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.04);
		}

		.hero-premium__cta-secondary:hover {
			transform: translateY(-2px);
			background: rgba(255, 255, 255, 0.14);
			border-color: rgba(255, 255, 255, 0.32);
		}

		.hero-premium__glow {
			filter: blur(70px);
			opacity: 0.4;
			pointer-events: none;
		}

		.hero-premium__glow--top {
			background: rgba(244, 114, 182, 0.28);
		}

		.hero-premium__glow--bottom {
			background: rgba(91, 33, 182, 0.22);
		}

		@keyframes heroContentFade {
			from {
				opacity: 0;
				transform: translate3d(0, 26px, 0);
			}
			to {
				opacity: 1;
				transform: translate3d(0, 0, 0);
			}
		}

		@keyframes heroImageZoom {
			from {
				transform: scale(1.04);
			}
			to {
				transform: scale(1.01);
			}
		}

		@media (max-width: 767px) {
			.hero-premium {
				min-height: 60vh;
			}

			.hero-premium__image {
				background-position: center 82%;
			}

			.hero-premium__overlay {
				background:
					linear-gradient(180deg, rgba(9, 13, 28, 0.62) 0%, rgba(42, 26, 70, 0.52) 50%, rgba(118, 38, 106, 0.34) 100%),
					linear-gradient(180deg, rgba(226, 61, 143, 0.1) 0%, rgba(10, 15, 28, 0.2) 100%);
			}
		}

		@media (prefers-reduced-motion: reduce) {
			.hero-premium__image,
			.hero-premium__content,
			.hero-premium__cta-primary,
			.hero-premium__cta-secondary {
				animation: none;
				transition: none;
			}

			.hero-premium__image {
				transform: scale(1.01);
			}
		}
	</style>
@endonce
