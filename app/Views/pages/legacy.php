<?php

declare(strict_types=1);

?>
<header class="ux-legacy-nav">
	<div class="ux-legacy-nav__inner">
		<a href="/" class="ux-legacy-nav__brand" aria-label="Inicio Bolivariano Online">
			<img src="/assets/images/logos/BolOnline.png" alt="Bolivariano Online">
		</a>
		<nav class="ux-legacy-nav__menu" aria-label="Navegación principal">
			<a href="/">Inicio</a>
			<a href="/admisiones">Admisiones</a>
			<a href="/oferta-academica">Oferta Académica</a>
			<a href="/formacion-continua">Formación Continua</a>
			<a href="/metodologia-estudio">Metodología</a>
			<a href="/faq">FAQ</a>
		</nav>
		<a href="/matriculate-online" class="ux-btn ux-btn--primary">Matricúlate Online</a>
	</div>
</header>

<section class="ux-legacy-hero">
	<div class="ux-legacy-hero__content">
		<h1><?= htmlspecialchars($title ?? 'Bolivariano Online', ENT_QUOTES, 'UTF-8') ?></h1>
		<p>Contenido institucional actualizado para una navegación más ágil, clara y moderna.</p>
		<div class="ux-legacy-hero__actions">
			<a href="/matriculate-online" class="ux-btn ux-btn--light">Matricúlate</a>
			<a href="/oferta-academica" class="ux-btn ux-btn--light">Ver Carreras</a>
		</div>
	</div>
</section>

<section class="ux-legacy-shell ux-legacy-shell--<?= htmlspecialchars($pageVariant ?? 'general', ENT_QUOTES, 'UTF-8') ?>">
	<div class="ux-legacy-content">
		<?= $pageContent ?? '' ?>
	</div>
</section>

<footer class="ux-legacy-footer">
	<div class="ux-legacy-footer__inner">
		<p>Instituto Superior Universitario Bolivariano · Educación en línea</p>
		<nav aria-label="Enlaces del pie">
			<a href="/admisiones">Admisiones</a>
			<a href="/oferta-academica">Oferta Académica</a>
			<a href="/matriculate-online">Matricúlate Online</a>
		</nav>
	</div>
</footer>
