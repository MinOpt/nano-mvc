<?php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
\App\Env::load(__DIR__ . '/../.env');

// 2. Регистрируем умный обработчик ошибок (вместо 3 строк с ini_set)
\App\Exceptions\Handler::register();

use App\Http\Request;
use App\Http\Response;
use App\Router;

$router = new Router();
require_once __DIR__ . '/../config/routes.php'; // Подключаем маршруты

$request = Request::createFromGlobals();
$response = $router->dispatch($request);
$response->send();