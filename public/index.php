<?php
/**
 * DevHealth - Front Controller (Router)
 */

session_start();

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$route = $_GET['route'] ?? '/';
$route = '/' . trim($route, '/');
$method = $_SERVER['REQUEST_METHOD'];

// --- Páginas públicas ---
if ($route === '/' || $route === '/home') {
    require __DIR__ . '/../views/home/index.php';
    exit;
}

// --- Autenticación ---
if ($route === '/auth/login' && $method === 'GET') {
    require_once __DIR__ . '/../controllers/AuthController.php';
    (new AuthController())->showLoginForm();
    exit;
}
if ($route === '/auth/login' && $method === 'POST') {
    require_once __DIR__ . '/../controllers/AuthController.php';
    (new AuthController())->login();
    exit;
}
if ($route === '/auth/register' && $method === 'POST') {
    require_once __DIR__ . '/../controllers/AuthController.php';
    (new AuthController())->register();
    exit;
}
if ($route === '/auth/logout') {
    require_once __DIR__ . '/../controllers/AuthController.php';
    (new AuthController())->logout();
    exit;
}

// --- Dashboard ---
if ($route === '/dashboard') {
    require_once __DIR__ . '/../controllers/DashboardController.php';
    (new DashboardController())->index();
    exit;
}

// --- Rutinas ---
if ($route === '/routines/generator' && $method === 'GET') {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->showGenerator();
    exit;
}
if ($route === '/routines/generate' && $method === 'POST') {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->generate();
    exit;
}
if (preg_match('#^/routines/active/(\d+)$#', $route, $matches)) {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->showActive((int) $matches[1]);
    exit;
}
if (preg_match('#^/routines/complete/(\d+)$#', $route, $matches)) {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->complete((int) $matches[1]);
    exit;
}

// --- 404 ---
http_response_code(404);
require __DIR__ . '/../views/layouts/404.php';
