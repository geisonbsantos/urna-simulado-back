<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Router;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function json(Request $request)
    {
        $router = app(Router::class);
        $routes = collect($router->getRoutes())->map(function ($route) {
            return [
                'methods' => $route->methods(),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'middleware' => $route->gatherMiddleware(),
            ];
        })->filter(function ($r) {
            // filtrar apenas rotas da API (prefix "api")
            return str_starts_with($r['uri'], 'api/');
        })->values();

        $paths = [];

        foreach ($routes as $r) {
            $rawUri = $r['uri'];
            $openapiPath = '/'.ltrim($rawUri, '/');
            // ensure path param curly braces are preserved
            $openapiPath = preg_replace('#\{([^/]+)\}#', '{$1}', $openapiPath);

            if (!isset($paths[$openapiPath])) $paths[$openapiPath] = [];

            // detect path parameters
            preg_match_all('#\{([^/]+)\}#', $rawUri, $matches);
            $pathParams = [];
            if (!empty($matches[1])) {
                foreach ($matches[1] as $param) {
                    $pathParams[] = [
                        'name' => $param,
                        'in' => 'path',
                        'required' => true,
                        'schema' => ['type' => 'string']
                    ];
                }
            }

            // detect if route is protected by auth middleware
            $middlewares = $r['middleware'];
            $isProtected = false;
            foreach ($middlewares as $m) {
                if (str_contains($m, 'auth') || str_contains($m, 'sanctum')) {
                    $isProtected = true;
                    break;
                }
            }

            foreach ($r['methods'] as $method) {
                if (in_array($method, ['HEAD'])) continue;
                $lower = strtolower($method);

                $operation = [
                    'tags' => [explode('/', $rawUri)[1] ?? 'api'],
                    'summary' => $r['name'] ?? $r['action'],
                    'responses' => [
                        '200' => ['description' => 'Success']
                    ],
                ];

                if (!empty($pathParams)) {
                    $operation['parameters'] = $pathParams;
                }

                if ($isProtected) {
                    $operation['security'] = [['bearerAuth' => []]];
                }

                $paths[$openapiPath][$lower] = $operation;
            }
        }

        $openapi = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => config('app.name').' API',
                'version' => '1.0.0',
            ],
            'paths' => new \ArrayObject($paths),
            'components' => [
                'securitySchemes' => [
                    'bearerAuth' => [
                        'type' => 'http',
                        'scheme' => 'bearer',
                        'bearerFormat' => 'JWT',
                    ],
                ],
            ],
            'security' => [
                ['bearerAuth' => []]
            ],
        ];

        return response()->json($openapi);
    }

    public function ui()
    {
        return view('docs');
    }

    /**
     * Check if l5-swagger is installed and redirect to its UI, otherwise show instruction JSON.
     */
    public function check()
    {
        if (class_exists(\L5Swagger\L5SwaggerServiceProvider::class) || class_exists(\L5Swagger\Generator::class)) {
            // default L5 route is /api/documentation - redirect
            return redirect('/api/documentation');
        }

        return response()->json([
            'installed' => false,
            'message' => 'l5-swagger não está instalado. Siga as instruções em /docs to install.',
        ]);
    }
}
