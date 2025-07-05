<?php

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '' || $uri === '/index') {
    require_once __DIR__ . '/../todo/index.php';
} elseif ($uri === '/add' && $method === 'POST') {
    require_once __DIR__ . '/../todo/add.php';
} elseif ($uri === '/delete' && $method === 'POST') {
    require_once __DIR__ . '/../todo/delete.php';
} elseif ($uri === '/complete' && $method === 'POST') {
    require_once __DIR__ . '/../todo/complete.php';
} elseif ($uri === '/edit' && ($method === 'POST' || $method === 'GET')) {
    require_once __DIR__ . '/../todo/edit.php';
} else {
    http_response_code(404);
    echo '404 Not Found';
}

