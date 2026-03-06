<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class BaseController
{
    protected function render(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        $viewPath = dirname(__DIR__) . '/Views/' . $view . '.php';
        $layoutPath = dirname(__DIR__) . '/Views/' . $layout . '.php';

        if (!is_file($viewPath)) {
            http_response_code(500);
            echo 'Vista no encontrada: ' . $view;
            return;
        }

        if (!is_file($layoutPath)) {
            http_response_code(500);
            echo 'Layout no encontrado: ' . $layout;
            return;
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require $layoutPath;
    }
}
