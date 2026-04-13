<?php
/**
 * Рендерит представление с опциональным лейаутом
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
 */
function partial(string $name, array $data = []): string {
    return view($name, $data, null);
}