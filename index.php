
<?php

session_start();

require __DIR__ . '/config/database.php';
require __DIR__ . '/models/Database.php';

$loggedIn = isset($_SESSION['usuario_id']);

$controllerName = $_GET['controller'] ?? ($loggedIn ? 'home' : 'auth');
$action = $_GET['action'] ?? 'index';

$controllerMap = [
    'auth' => 'AuthController',
    'home' => 'HomeController',
    'usuarios' => 'UsuarioController',
    'citas' => 'CitaController',
];

// Obtener las acciones públicas de los controladores registrados.
$controllerActions = [];

foreach ($controllerMap as $name => $class) {
    $file = __DIR__ . '/controllers/' . $class . '.php';

    if (!file_exists($file)) {
        $controllerActions[$name] = [];
        continue;
    }

    require_once $file;

    if (!class_exists($class)) {
        $controllerActions[$name] = [];
        continue;
    }

    $reflection = new ReflectionClass($class);
    $actions = [];

    foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
        if (
            $method->getDeclaringClass()->getName() === $class
            && !$method->isConstructor()
            && !$method->isDestructor()
            && !str_starts_with($method->getName(), '_')
        ) {
            $actions[] = $method->getName();
        }
    }

    sort($actions);
    $controllerActions[$name] = $actions;
}

// Comprobar la existencia del controlador y la acción.
$controllerExists = array_key_exists($controllerName, $controllerMap);

$allActions = [];

foreach ($controllerActions as $actions) {
    $allActions = array_merge($allActions, $actions);
}

$actionExistsGlobally = in_array($action, $allActions, true);

$errorTitle = null;
$errorDescription = '';
$availableControllers = [];

if (!$controllerExists && !$actionExistsGlobally) {

    $errorTitle = 'El controlador y la acción no existe.';
    $errorDescription = 'No se encontró el controlador ni la acción solicitada.';
    $availableControllers = $controllerActions;

} elseif (!$controllerExists) {

    $errorTitle = 'Controlador no existe';
    $errorDescription = 'El controlador solicitado no está registrado en el sistema.';
    $availableControllers = $controllerActions;

} elseif (!in_array($action, $controllerActions[$controllerName] ?? [], true)) {

    $errorTitle = 'La acción no existe';
    $errorDescription = "El controlador «{$controllerName}» existe, pero no contiene la acción «{$action}».";
    $availableControllers = [
        $controllerName => $controllerActions[$controllerName]
    ];
}

// Si hay un error, cargar la vista y detener la ejecución.
if ($errorTitle !== null) {
    http_response_code(404);

    require __DIR__ . '/views/error/index.php';
    exit;
}

// Mantener las restricciones de sesión del sistema.
if (!$loggedIn && $controllerName !== 'auth') {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

if ($loggedIn && $controllerName === 'auth' && $action !== 'logout') {
    header('Location: index.php?controller=home&action=index');
    exit;
}

// Ejecutar el controlador y la acción válidos.
$controllerClass = $controllerMap[$controllerName];
$controller = new $controllerClass();

$controller->$action();
