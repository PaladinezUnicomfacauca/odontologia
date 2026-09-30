<?php

session_start();

require __DIR__ . '/config/database.php';
require __DIR__ . '/models/Database.php';

$loggedIn = isset($_SESSION['usuario_id']);
$controllerName = $_GET['controller'] ?? ($loggedIn ? 'home' : 'auth');
$action = $_GET['action'] ?? 'index';

if (!$loggedIn && $controllerName !== 'auth') {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

if ($loggedIn && $controllerName === 'auth') {
    header('Location: index.php?controller=home&action=index');
    exit;
}

$controllerMap = [
    'auth' => 'AuthController',
    'home' => 'HomeController',
    'usuarios' => 'UsuarioController',
    'citas' => 'CitaController',
];

$controllerClass = $controllerMap[$controllerName] ?? $controllerMap['home'];
$controllerFile = __DIR__ . '/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo 'Controlador no encontrado.';
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    http_response_code(500);
    echo 'La clase del controlador no existe.';
    exit;
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo 'Acción no encontrada.';
    exit;
}

$controller->$action();
