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