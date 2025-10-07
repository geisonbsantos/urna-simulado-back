<?php

use App\Http\Middleware\RefreshTokenSanctum;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
            'refreshTokenSanctum' => RefreshTokenSanctum::class,
        ]);
        $middleware->append([RefreshTokenSanctum::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Captura erros HTTP, incluindo os 403 do middleware Sanctum
        $exceptions->render(function (HttpException $e, $request) {
            if ($e->getStatusCode() === 403) {
                return response()->json([
                    'error' => 'Você não tem permissão para acessar esta rota.'
                ], 403);
            }

            if ($e->getStatusCode() === 401) {
                return response()->json([
                    'error' => 'Usuário não autenticado.'
                ], 401);
            }

            // Se não for 401 ou 403, deixa o Laravel tratar normalmente
            return null;
        });
    })
    ->create();
