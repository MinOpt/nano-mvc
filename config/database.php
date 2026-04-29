<?php
// config/database.php
return [
    'host'     => \App\Env::get('DB_HOST', '127.0.0.1'),
    'database' => \App\Env::get('DB_NAME', 'nano'),
    'username' => \App\Env::get('DB_USER', 'root'),
    'password' => \App\Env::get('DB_PASS', ''),
];