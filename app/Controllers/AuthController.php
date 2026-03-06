<?php

declare(strict_types=1);

namespace App\Controllers;

final class AuthController extends BaseController
{
    public function showLogin(): void
    {
        http_response_code(501);
        echo 'Login MVC en implementación';
    }

    public function login(): void
    {
        http_response_code(501);
        echo 'Autenticación MVC en implementación';
    }
}
