<?php
/**
 * DevHealth - Funciones auxiliares
 */

/**
 * Escapar HTML para prevenir XSS
 */
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirigir a una URL
 */
function redirect(string $path): void {
    header("Location: " . BASE_URL . $path);
    exit;
}

/**
 * Verificar si el usuario está autenticado
 */
function isAuthenticated(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Obtener datos del usuario de la sesión
 */
function currentUser(): ?array {
    if (!isAuthenticated()) return null;
    return $_SESSION['user'] ?? null;
}

/**
 * Requerir autenticación (redirigir si no está logueado)
 */
function requireAuth(): void {
    if (!isAuthenticated()) {
        $_SESSION['flash_error'] = 'Debes iniciar sesión para acceder a esta página.';
        redirect('/auth/login');
    }
}

/**
 * Redirigir si ya está autenticado (para login/register)
 */
function redirectIfAuthenticated(): void {
    if (isAuthenticated()) {
        redirect('/dashboard');
    }
}

/**
 * Establecer un mensaje flash
 */
function setFlash(string $type, string $message): void {
    $_SESSION["flash_{$type}"] = $message;
}

/**
 * Obtener y limpiar un mensaje flash
 */
function getFlash(string $type): ?string {
    $key = "flash_{$type}";
    $message = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
    return $message;
}

/**
 * Obtener token CSRF
 */
function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Campo hidden con token CSRF
 */
function csrfField(): string {
    return '<input type="hidden" name="csrf_token" value="' . csrfToken() . '">';
}

/**
 * Validar token CSRF
 */
function validateCsrf(): bool {
    $token = $_POST['csrf_token'] ?? '';
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

/**
 * Generar URL completa
 */
function url(string $path = ''): string {
    return BASE_URL . $path;
}

/**
 * Verificar si la ruta actual coincide (para active state del nav)
 */
function isRoute(string $route): bool {
    $currentPath = $_GET['route'] ?? '/';
    return '/' . ltrim($currentPath, '/') === $route;
}
