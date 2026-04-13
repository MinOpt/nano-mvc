<?php
namespace App;

use App\Http\Request;
use App\Http\Response;

class Router
{
    private array $routes = [];
    /**
     * Регистрирует GET-маршрут
     *
     * @param string $path    Путь без начального слэша (например: '/about')
     * @param string $handler Строка вида 'Controller@method'
     */
    public function get(string $path, string $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void {
        $this->routes['POST'][$path] = $handler;
    }
    /**
     * Отправляет запрос нужному контроллеру
     *
     * @param Request $request Текущий HTTP-запрос
     * @return Response        HTTP-ответ
     */
    public function dispatch(Request $request): Response {
        $method = $request->getMethod();
        $path = $request->getPath();

        if (isset($this->routes[$method][$path])) {
            [$controller, $action] = explode('@', $this->routes[$method][$path]);
            $class = "App\\Controllers\\{$controller}";
            $instance = new $class();
            $content = $instance->$action($request);

            if (is_string($content)) return Response::html($content);
            if ($content instanceof Response) return $content;
        }

        return Response::html('404 Not Found', 404);
    }
}