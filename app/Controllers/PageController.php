<?php

declare(strict_types=1);

namespace App\Controllers;

final class PageController extends BaseController
{
    private const LEGACY_ROOT = 'proyecto old';

    public function admisiones(): void
    {
        $this->renderLegacyPage('admisiones-iub.html', 'Admisiones - Instituto Bolivariano Online');
    }

    public function ofertaAcademica(): void
    {
        $this->renderLegacyPage('oferta-academica.html', 'Oferta Académica - Instituto Bolivariano Online');
    }

    public function formacionContinua(): void
    {
        $this->renderLegacyPage('formacion-continua.html', 'Formación Continua - Instituto Bolivariano Online');
    }

    public function metodologiaEstudio(): void
    {
        $this->renderLegacyPage('metodologia-estudio.html', 'Metodología de Estudio - Instituto Bolivariano Online');
    }

    public function pregrado(): void
    {
        $this->renderLegacyPage('pregrado.html', 'Pregrado - Instituto Bolivariano Online');
    }

    public function faq(): void
    {
        $this->renderLegacyPage('faq.html', 'Preguntas Frecuentes - Instituto Bolivariano Online');
    }

    public function evento1(): void
    {
        $this->renderLegacyPage('eventos/evento1.html', 'Evento 1 - Instituto Bolivariano Online');
    }

    public function evento2(): void
    {
        $this->renderLegacyPage('eventos/evento2.html', 'Evento 2 - Instituto Bolivariano Online');
    }

    public function evento3(): void
    {
        $this->renderLegacyPage('eventos/evento3.html', 'Evento 3 - Instituto Bolivariano Online');
    }

    public function carreraUniversitaria(string $slug, string $title): void
    {
        $this->renderLegacyPage('carreras/universitarias/' . $slug . '.html', $title);
    }

    public function diplomado(string $slug, string $title): void
    {
        $this->renderLegacyPage('carreras/diplomados/' . $slug . '.html', $title);
    }

    private function renderLegacyPage(string $fileName, string $title): void
    {
        $basePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . self::LEGACY_ROOT;
        $fullPath = $basePath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $fileName);

        if (!is_file($fullPath)) {
            http_response_code(404);
            echo '404 - Página no encontrada';
            return;
        }

        $html = (string) file_get_contents($fullPath);
        $content = $this->extractBody($html);
        $content = $this->stripLegacyChrome($content);
        $content = $this->normalizeLegacyLinks($content);
        $variant = $this->resolveVariant($fileName);

        $this->render('pages/legacy', [
            'title' => $title,
            'metaDescription' => 'Instituto Superior Universitario Bolivariano Online',
            'pageContent' => $content,
            'pageVariant' => $variant,
        ]);
    }

    private function extractBody(string $html): string
    {
        if (preg_match('~<body[^>]*>(.*)</body>~is', $html, $matches) === 1) {
            return (string) $matches[1];
        }

        return $html;
    }

    private function normalizeLegacyLinks(string $content): string
    {
        $map = [
            'href="index.html"' => 'href="/"',
            'href="/index.html"' => 'href="/"',
            'href="admisiones-iub.html"' => 'href="/admisiones"',
            'href="oferta-academica.html"' => 'href="/oferta-academica"',
            'href="formacion-continua.html"' => 'href="/formacion-continua"',
            'href="metodologia-estudio.html"' => 'href="/metodologia-estudio"',
            'href="pregrado.html"' => 'href="/pregrado"',
            'href="faq.html"' => 'href="/faq"',
            'href="matriculate-online.php"' => 'href="/matriculate-online"',
            'href="/matriculate-online.php"' => 'href="/matriculate-online"',
            'href="http://bolivarianonline.atwebpages.com/matriculate-online.php"' => 'href="/matriculate-online"',
            'href="https://bolivarianonline.atwebpages.com/matriculate-online.php"' => 'href="/matriculate-online"',
            'href="misfinanzas-matricualate.php"' => 'href="/matriculate-online/misfinanzas-matricualate.php"',
            'href="/misfinanzas-matricualate.php"' => 'href="/matriculate-online/misfinanzas-matricualate.php"',
            'href="/eventos/evento1.html"' => 'href="/eventos/evento1"',
            'href="/eventos/evento2.html"' => 'href="/eventos/evento2"',
            'href="/eventos/evento3.html"' => 'href="/eventos/evento3"',
            'href="eventos/evento1.html"' => 'href="/eventos/evento1"',
            'href="eventos/evento2.html"' => 'href="/eventos/evento2"',
            'href="eventos/evento3.html"' => 'href="/eventos/evento3"',
            'href="/carreras/universitarias/admempresas.html"' => 'href="/carreras/universitarias/admempresas"',
            'href="/carreras/universitarias/basica.html"' => 'href="/carreras/universitarias/basica"',
            'href="/carreras/universitarias/calidadProductividad.html"' => 'href="/carreras/universitarias/calidad-productividad"',
            'href="/carreras/universitarias/contabilidad.html"' => 'href="/carreras/universitarias/contabilidad"',
            'href="/carreras/universitarias/inicial.html"' => 'href="/carreras/universitarias/inicial"',
            'href="/carreras/universitarias/salud.html"' => 'href="/carreras/universitarias/salud"',
            'href="/carreras/universitarias/tecnologia.html"' => 'href="/carreras/universitarias/tecnologia"',
            'href="/carreras/diplomados/adultomayor.html"' => 'href="/carreras/diplomados/adulto-mayor"',
            'href="/carreras/diplomados/cuidadospacientecritico.html"' => 'href="/carreras/diplomados/cuidados-paciente-critico"',
            'href="/carreras/diplomados/gestion-proyectos.html"' => 'href="/carreras/diplomados/gestion-proyectos"',
            'href="/carreras/diplomados/instrumentacion.html"' => 'href="/carreras/diplomados/instrumentacion"',
        ];

        $normalized = str_replace(array_keys($map), array_values($map), $content);

        return str_replace(' loading="lazy"', ' loading="lazy" decoding="async"', $normalized);
    }

    private function stripLegacyChrome(string $content): string
    {
        $withoutHeader = (string) preg_replace(
            '~<header[^>]*class="[^"]*\bhero\b[^"]*"[^>]*>.*?</header>~is',
            '',
            $content,
            1
        );

        $withoutFooter = (string) preg_replace(
            '~<footer[^>]*>.*?</footer>~is',
            '',
            $withoutHeader
        );

        return trim($withoutFooter);
    }

    private function resolveVariant(string $fileName): string
    {
        if (str_contains($fileName, 'faq')) {
            return 'faq';
        }

        if (str_starts_with($fileName, 'carreras/')) {
            return 'carreras';
        }

        if (str_starts_with($fileName, 'eventos/')) {
            return 'eventos';
        }

        return 'general';
    }
}
