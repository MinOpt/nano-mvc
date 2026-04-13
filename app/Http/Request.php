<?php
namespace App\Http;

class Request
{
    private string $basePath;

    public function __construct() {
        $config = require __DIR__ . '/../../config/app.php';
        $this->basePath = rtrim($config['base_path'] ?? '', '/');
    }

    public static function createFromGlobals(): self {
        return new self();
    }

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath(): string {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Убираем базовый путь, если он есть
        if ($this->basePath && str_starts_with($uri, $this->basePath)) {
            $uri = substr($uri, strlen($this->basePath));
        }
        
        return '/' . ltrim($uri, '/');
    }

    public function input(string $key, $default = null) {
        return $_REQUEST[$key] ?? $default;
    }

    // Полезный хелпер для генерации ссылок с учётом basePath
    public function url(string $path): string {
        $path = '/' . ltrim($path, '/');
        return $this->basePath . $path;
    }
}