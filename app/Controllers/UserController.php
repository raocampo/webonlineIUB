<?php

declare(strict_types=1);

namespace App\Controllers;

final class UserController extends BaseController
{
    public function dashboard(): void
    {
        http_response_code(501);
        echo 'Dashboard MVC en implementación';
    }
}
