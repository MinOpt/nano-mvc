<?php
/**
 * Рендерит представление с автоматическим оборачиванием в layout
 *
 * @param string      $name    Имя файла в app/Views/ (без .php)
 * @param array       $data    Переменные для шаблона
 * @param string|null $layout  Имя layout-файла или null для чистого вывода
 * @return string              Отрендеренный HTML
 */
function view(string $name, array $data = [], ?string $layout = 'layout'): string
{
    // 1. Рендерим контент (извлекаем переменные в локальную область)
    $content = (function(string $view, array $vars): string {
        extract($vars, EXTR_SKIP);
        ob_start();
        require __DIR__ . "/Views/{$view}.php";
        return ob_get_clean();
    })($name, $data);

    // 2. Если лейаут не нужен — возвращаем чистый контент
    if ($layout === null) {
        return $content;
    }

    // 3. Оборачиваем в лейаут
    return (function(string $layout, string $content, array $data): string {
        extract($data, EXTR_SKIP);
        ob_start();
        require __DIR__ . "/Views/{$layout}.php";
        return ob_get_clean();
    })($layout, $content, $data);
}

/**
 * Рендерит представление БЕЗ лейаута (для API, email, partials)
 *
 * @param string $name
 * @param array $data
 * @return string
 */
function partial(string $name, array $data = []): string {
    return view($name, $data, null);
}

/**
 * Логирует запрос в свой файл
 */
function log_request(string $method, string $path): void
{
    if ($path === '/favicon.ico') return;
    $logFile = __DIR__ . '/../storage/logs/request.log';
    $logDir  = dirname($logFile);

    // Создаём папку автоматически, если её нет
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    $ip        = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $message   = "[$timestamp] $ip | $method $path" . PHP_EOL;

    // 3 = дозапись в указанный файл
    error_log($message, 3, $logFile);
}

/**
 * Логирует переменную или массив в файл отладки
 * 
 * @param string $label Метка для поиска в логе
 * @param mixed  $value Любая переменная, массив или объект
 */
function debug_log(string $label, mixed $value): void
{
    $logFile = __DIR__ . '/../storage/logs/debug.log';
    $logDir  = dirname($logFile);

    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    // print_r с true возвращает строку вместо вывода в экран
    $dump = print_r($value, true);
    $message = "[$timestamp] 🔍 $label\n$dump\n" . str_repeat('─', 50) . "\n";

    error_log($message, 3, $logFile);
}

/**
 * Возвращает 'active', если текущий путь совпадает с переданным
 */
function isActive(string $path): string
{
    // Используем ваш Request, чтобы корректно отрезать base_path (если проект в подпапке)
    $current = \App\Http\Request::createFromGlobals()->getPath();
    return rtrim($current, '/') === rtrim($path, '/') ? 'active' : '';
}