<?php

declare(strict_types=1);

namespace App\Middleware;

final class CsrfMiddleware
{
    public static function handle(?string $token): bool
    {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }

        if ($token === null) {
            return false;
        }

        return hash_equals((string) $_SESSION['csrf_token'], $token);
    }
}
