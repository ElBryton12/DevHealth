<?php
/**
 * DevHealth - Front Controller (Router)
 * 
 * Punto de entrada único. Todas las peticiones
 * pasan por aquí gracias al .htaccess en /public.
 */

session_start();

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$route  = $_GET['route'] ?? '/';
$route  = '/' . trim($route, '/');
$method = $_SERVER['REQUEST_METHOD'];

// ================================================
// PÁGINAS PÚBLICAS
// ================================================

if ($route === '/' || $route === '/home') {
    require __DIR__ . '/../views/home/index.php';
    exit;
}

// ================================================
// AUTENTICACIÓN
// ================================================

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

// ================================================
// DASHBOARD
// ================================================

if ($route === '/dashboard') {
    require_once __DIR__ . '/../controllers/DashboardController.php';
    (new DashboardController())->index();
    exit;
}

// ================================================
// RUTINAS
// ================================================

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

if (preg_match('#^/routines/active/(\d+)$#', $route, $m)) {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->showActive((int) $m[1]);
    exit;
}

if (preg_match('#^/routines/complete/(\d+)$#', $route, $m)) {
    require_once __DIR__ . '/../controllers/RoutineController.php';
    (new RoutineController())->complete((int) $m[1]);
    exit;
}

// ================================================
// HISTORIAL
// ================================================

if ($route === '/history' || $route === '/routines/history') {
    requireAuth();
    // La vista de Eduardo es autocontenida (incluye sus propios modelos)
    require __DIR__ . '/../views/history/history_log.php';
    exit;
}

// ================================================
// EDUCACIÓN
// ================================================

if ($route === '/education/postural') {
    // Vista estática autocontenida de Eduardo
    require __DIR__ . '/../views/education/postural.php';
    exit;
}

if ($route === '/education/visual' || $route === '/education/visual-health' || $route === '/education/visual_health')  {
    // Vista estática autocontenida de Eduardo
    require __DIR__ . '/../views/education/visual_health_guide.php';
    exit;
}

// ================================================
// SOPORTE / CONTACTO
// ================================================

if ($route === '/support/contact' && $method === 'GET') {
    // Vista autocontenida de Eduardo
    require __DIR__ . '/../views/support/contact.php';
    exit;
}

if ($route === '/support/send' && $method === 'POST') {
    require_once __DIR__ . '/../controllers/ContactController.php';
    (new ContactController())->send();
    exit;
}

// Alias: el footer usa /support
if ($route === '/support') {
    redirect('/support/contact');
    exit;
}

// ================================================
// 404
// ================================================

http_response_code(404);
require __DIR__ . '/../views/layouts/404.php';
