<?php
/**
 * DevHealth - Landing Page (placeholder)
 * Se convertirá desde index.html en la siguiente fase.
 */
$pageTitle = 'Inicio';
require __DIR__ . '/../layouts/head.php';
?>
<body class="bg-background-light dark:bg-background-dark font-sans antialiased min-h-screen flex flex-col">

<!-- Nav público -->
<nav class="sticky top-0 z-50 bg-surface-light/90 dark:bg-surface-dark/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="<?= url('/') ?>" class="flex items-center gap-2">
                    <span class="material-icons-outlined text-primary text-3xl">monitor_heart</span>
                    <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white"><?= APP_NAME ?></span>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a class="text-gray-500 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium" href="<?= url('/auth/login') ?>">Login</a>
                <a class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md transition-all" href="<?= url('/auth/login?tab=register') ?>">
                    Registrarse
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="flex-1 flex items-center justify-center py-20 px-4">
    <div class="text-center max-w-3xl">
        <span class="material-icons-outlined text-primary text-7xl mb-6">health_and_safety</span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
            Tu asistente de <span class="text-primary">bienestar digital</span>
        </h1>
        <p class="text-xl text-gray-500 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
            Rutinas de pausas activas, guías de higiene postural y ejercicios de salud visual 
            diseñados para desarrolladores y estudiantes de computación.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= url('/auth/login?tab=register') ?>" class="bg-primary hover:bg-primary-hover text-white px-8 py-4 rounded-xl text-lg font-semibold shadow-lg transition-all transform hover:scale-105">
                Comenzar Gratis
            </a>
            <a href="<?= url('/auth/login') ?>" class="border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary hover:text-primary px-8 py-4 rounded-xl text-lg font-semibold transition-all">
                Iniciar Sesión
            </a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
