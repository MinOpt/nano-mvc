<?php
namespace App\Exceptions;

class Handler
{
    public static function register(): void
    {
        // Читаем режим отладки из .env
        $debug = \App\Env::get('APP_DEBUG', 'false') === 'true';

        // Настраиваем отображение ошибок в зависимости от режима
        ini_set('display_errors', $debug ? '1' : '0');
        ini_set('display_startup_errors', $debug ? '1' : '0');
        error_reporting($debug ? E_ALL : E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        // Глобальный перехват необработанных исключений
        set_exception_handler(function (\Throwable $e) use ($debug) {
            if ($debug) {
                // На локалке: показываем подробно
                echo "<pre style='background:#1e1e1e;color:#d4d4d4;padding:1rem;font-family:monospace'>";
                echo htmlspecialchars($e);
                echo "</pre>";
            } else {
                // На проде: тихо и безопасно
                http_response_code(500);
                // Можно подключить красивый шаблон: require __DIR__.'/../../app/Views/errors/500.php';
                echo "<h1>Ошибка сервера</h1><p>Попробуйте позже.</p>";
                // Логируем для себя
                error_log("[$e]");
            }
            exit; // Гарантируем остановку скрипта
        });

        // Превращаем предупреждения PHP в исключения (для единообразия)
        set_error_handler(function ($errno, $errstr, $file, $line) {
            throw new \ErrorException($errstr, 0, $errno, $file, $line);
        });
    }
}