<?php $pageTitle = 'Página no encontrada'; require __DIR__ . '/head.php'; ?>
<body class="bg-background-light dark:bg-background-dark font-sans antialiased min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <span class="material-icons-round text-primary text-8xl mb-4">explore_off</span>
        <h1 class="text-6xl font-bold text-gray-900 dark:text-white mb-2">404</h1>
        <p class="text-xl text-gray-500 dark:text-gray-400 mb-8">La página que buscas no existe.</p>
        <a href="<?= url('/') ?>" class="bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-lg font-medium transition-colors inline-flex items-center gap-2">
            <span class="material-icons-round">home</span> Volver al inicio
        </a>
    </div>
</body>
</html>
