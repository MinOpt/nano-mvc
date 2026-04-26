<?php
declare(strict_types=1);

// === ВКЛЮЧИТЬ ОТЛАДКУ ===
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// =========================

require_once __DIR__ . '/../vendor/autoload.php';
// ... остальной код

use App\Http\Request;
use App\Http\Response;
use App\Router;

// Базовая обработка ошибок
set_exception_handler(fn($e) => Response::html("<pre>{$e}</pre>", 500)->send());
set_error_handler(fn($errno, $errstr) => throw new ErrorException($errstr, 0, $errno));

$router = new Router();
require_once __DIR__ . '/../config/routes.php'; // Подключаем маршруты

$request = Request::createFromGlobals();

// 📝 Логируем каждый запрос
log_request($request->getMethod(), $request->getPath());


$response = $router->dispatch($request);
$response->send();