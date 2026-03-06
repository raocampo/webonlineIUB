<?php

declare(strict_types=1);

namespace App\Controllers;

final class HomeController extends BaseController
{
    public function index(): void
    {
        $this->render('home/index', [
            'title' => 'Inicio - Instituto Bolivariano Online',
            'metaDescription' => 'Instituto Superior Universitario Bolivariano Online - Educación superior de calidad 100% en línea.',
        ]);
    }
}
