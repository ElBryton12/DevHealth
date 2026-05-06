<?php
/**
 * DevHealth - Configuración General de la Aplicación
 */

// Nombre de la aplicación
define('APP_NAME', 'DevHealth');
define('APP_TAGLINE', 'Salud Ocupacional para Desarrolladores');
define('APP_VERSION', '1.0.0');

// URL base (ajustar según tu entorno)
define('BASE_URL', '');

// Zona horaria
date_default_timezone_set('America/Mexico_City');

// Sesión
define('SESSION_LIFETIME', 3600); // 1 hora

// Colores del tema (referencia para componentes dinámicos)
define('THEME_PRIMARY', '#6366f1');
define('THEME_PRIMARY_HOVER', '#4f46e5');
