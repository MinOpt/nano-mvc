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
    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }
    /**
     * Отправляет запрос нужному контроллеру
     *
     * @param Request $request Текущий HTTP-запрос
     * @return Response        HTTP-ответ
     */
    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $path = $request->getPath();


        // В dispatch(), перед проверкой isset($this->routes[$method][$path])
        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = preg_replace('/\{(\w+)\}/', '([\w-]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            // Внутри dispatch(), когда найдено совпадение с параметрами:
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // убираем полное совпадение (индекс 0)

                $request->setParams($matches); // ✅ теперь метод существует

                // Вызов контроллера как обычно:
                [$controllerName, $method] = explode('@', $handler);
                $controller = new $controllerName();
                return $controller->$method($request);
            }
        }
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
