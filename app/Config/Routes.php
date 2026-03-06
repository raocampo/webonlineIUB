<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\UserController;

final class Routes
{
    private array $routes = [];

    public function __construct()
    {
        $this->get('/', [HomeController::class, 'index']);
        $this->get('/admisiones', [PageController::class, 'admisiones']);
        $this->get('/oferta-academica', [PageController::class, 'ofertaAcademica']);
        $this->get('/formacion-continua', [PageController::class, 'formacionContinua']);
        $this->get('/metodologia-estudio', [PageController::class, 'metodologiaEstudio']);
        $this->get('/pregrado', [PageController::class, 'pregrado']);
        $this->get('/faq', [PageController::class, 'faq']);
        $this->get('/eventos/evento1', [PageController::class, 'evento1']);
        $this->get('/eventos/evento2', [PageController::class, 'evento2']);
        $this->get('/eventos/evento3', [PageController::class, 'evento3']);
        $this->get('/matriculate-online', static function (): void {
            header('Location: /matriculate-online/inicio_matriculate.php', true, 302);
            exit;
        });
        $this->get('/matriculate-online/inicio_matriculate.php', static function (): void {
            require dirname(__DIR__, 2) . '/matriculate-online/inicio_matriculate.php';
        });

        $this->get('/carreras/universitarias/admempresas', static function (): void {
            (new PageController())->carreraUniversitaria('admempresas', 'Administración de Empresas - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/basica', static function (): void {
            (new PageController())->carreraUniversitaria('basica', 'Educación Básica - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/calidad-productividad', static function (): void {
            (new PageController())->carreraUniversitaria('calidadProductividad', 'Calidad y Productividad - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/contabilidad', static function (): void {
            (new PageController())->carreraUniversitaria('contabilidad', 'Contabilidad - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/inicial', static function (): void {
            (new PageController())->carreraUniversitaria('inicial', 'Educación Inicial - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/salud', static function (): void {
            (new PageController())->carreraUniversitaria('salud', 'Ciencias de la Salud - Instituto Bolivariano Online');
        });
        $this->get('/carreras/universitarias/tecnologia', static function (): void {
            (new PageController())->carreraUniversitaria('tecnologia', 'Tecnología - Instituto Bolivariano Online');
        });

        $this->get('/carreras/diplomados/adulto-mayor', static function (): void {
            (new PageController())->diplomado('adultomayor', 'Diplomado Adulto Mayor - Instituto Bolivariano Online');
        });
        $this->get('/carreras/diplomados/cuidados-paciente-critico', static function (): void {
            (new PageController())->diplomado('cuidadospacientecritico', 'Diplomado Cuidados del Paciente Crítico - Instituto Bolivariano Online');
        });
        $this->get('/carreras/diplomados/gestion-proyectos', static function (): void {
            (new PageController())->diplomado('gestion-proyectos', 'Diplomado Gestión de Proyectos - Instituto Bolivariano Online');
        });
        $this->get('/carreras/diplomados/instrumentacion', static function (): void {
            (new PageController())->diplomado('instrumentacion', 'Diplomado Instrumentación - Instituto Bolivariano Online');
        });

        $this->get('/index.html', static function (): void {
            header('Location: /', true, 301);
            exit;
        });
        $this->get('/admisiones-iub.html', static function (): void {
            header('Location: /admisiones', true, 301);
            exit;
        });
        $this->get('/oferta-academica.html', static function (): void {
            header('Location: /oferta-academica', true, 301);
            exit;
        });
        $this->get('/formacion-continua.html', static function (): void {
            header('Location: /formacion-continua', true, 301);
            exit;
        });
        $this->get('/metodologia-estudio.html', static function (): void {
            header('Location: /metodologia-estudio', true, 301);
            exit;
        });
        $this->get('/pregrado.html', static function (): void {
            header('Location: /pregrado', true, 301);
            exit;
        });
        $this->get('/faq.html', static function (): void {
            header('Location: /faq', true, 301);
            exit;
        });
        $this->get('/matriculate-online.php', static function (): void {
            header('Location: /matriculate-online/inicio_matriculate.php', true, 301);
            exit;
        });
        $this->get('/eventos/evento1.html', static function (): void {
            header('Location: /eventos/evento1', true, 301);
            exit;
        });
        $this->get('/eventos/evento2.html', static function (): void {
            header('Location: /eventos/evento2', true, 301);
            exit;
        });
        $this->get('/eventos/evento3.html', static function (): void {
            header('Location: /eventos/evento3', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/admempresas.html', static function (): void {
            header('Location: /carreras/universitarias/admempresas', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/basica.html', static function (): void {
            header('Location: /carreras/universitarias/basica', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/calidadProductividad.html', static function (): void {
            header('Location: /carreras/universitarias/calidad-productividad', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/contabilidad.html', static function (): void {
            header('Location: /carreras/universitarias/contabilidad', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/inicial.html', static function (): void {
            header('Location: /carreras/universitarias/inicial', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/salud.html', static function (): void {
            header('Location: /carreras/universitarias/salud', true, 301);
            exit;
        });
        $this->get('/carreras/universitarias/tecnologia.html', static function (): void {
            header('Location: /carreras/universitarias/tecnologia', true, 301);
            exit;
        });
        $this->get('/carreras/diplomados/adultomayor.html', static function (): void {
            header('Location: /carreras/diplomados/adulto-mayor', true, 301);
            exit;
        });
        $this->get('/carreras/diplomados/cuidadospacientecritico.html', static function (): void {
            header('Location: /carreras/diplomados/cuidados-paciente-critico', true, 301);
            exit;
        });
        $this->get('/carreras/diplomados/gestion-proyectos.html', static function (): void {
            header('Location: /carreras/diplomados/gestion-proyectos', true, 301);
            exit;
        });
        $this->get('/carreras/diplomados/instrumentacion.html', static function (): void {
            header('Location: /carreras/diplomados/instrumentacion', true, 301);
            exit;
        });

        $this->get('/login', [AuthController::class, 'showLogin']);
        $this->post('/login', [AuthController::class, 'login']);
        $this->get('/dashboard', [UserController::class, 'dashboard'], ['auth']);
        $this->get('/health', static function (): void {
            echo 'ok';
        });
    }

    public function get(string $path, callable|array $handler, array $middlewares = []): void
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    public function post(string $path, callable|array $handler, array $middlewares = []): void
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    private function addRoute(string $method, string $path, callable|array $handler, array $middlewares): void
    {
        $normalizedPath = $this->normalizePath($path);
        $this->routes[$method][$normalizedPath] = [
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = $this->normalizePath((string) (parse_url($uri, PHP_URL_PATH) ?: '/'));
        $method = strtoupper($method);

        if (!isset($this->routes[$method][$path])) {
            $this->respondNotFound($path);
            return;
        }

        $route = $this->routes[$method][$path];
        $this->runMiddlewares($route['middlewares']);

        $handler = $route['handler'];

        if (is_array($handler) && isset($handler[0], $handler[1]) && is_string($handler[0])) {
            $controller = new $handler[0]();
            $action = $handler[1];
            $controller->{$action}();
            return;
        }

        if (is_callable($handler)) {
            $handler();
            return;
        }

        http_response_code(500);
        echo '500 - Handler de ruta inválido';
    }

    private function runMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            if ($middleware === 'auth' && empty($_SESSION['usuario_id'])) {
                header('Location: /login');
                exit;
            }
        }
    }

    private function normalizePath(string $path): string
    {
        $trimmed = rtrim($path, '/');
        return $trimmed === '' ? '/' : $trimmed;
    }

    private function respondNotFound(string $path): void
    {
        http_response_code(404);
        $safePath = htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Página no encontrada - Instituto Bolivariano Online</title>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <style>
            body { background: #f0f4ff; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Segoe UI', sans-serif; }
            .not-found { text-align: center; padding: 3rem; }
            .not-found h1 { font-size: 6rem; font-weight: 800; color: #1D327B; line-height: 1; }
            .not-found h2 { font-size: 1.5rem; color: #333; margin-bottom: 1rem; }
            .not-found p { color: #666; margin-bottom: 2rem; }
            .btn-home { background: #1D327B; color: #fff; padding: 0.75rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.2s; }
            .btn-home:hover { background: #152459; color: #fff; }
          </style>
        </head>
        <body>
          <div class="not-found">
            <h1>404</h1>
            <h2>Página no encontrada</h2>
            <p>La página <strong>{$safePath}</strong> no existe o fue movida.</p>
            <a href="/" class="btn-home">Volver al inicio</a>
          </div>
        </body>
        </html>
        HTML;
    }
}
