<?php
function view(string $name, array $data = []): string {
    extract($data);
    ob_start();
    require __DIR__ . "/Views/{$name}.php";
    return ob_get_clean();
}