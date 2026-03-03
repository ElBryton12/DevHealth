<footer class="bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
        <nav aria-label="Footer" class="-mx-5 -my-2 flex flex-wrap justify-center">
            <div class="px-5 py-2">
                <a class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white" href="<?= url('/') ?>">Inicio</a>
            </div>
            <div class="px-5 py-2">
                <a class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white" href="<?= url('/education/postural') ?>">Higiene Postural</a>
            </div>
            <div class="px-5 py-2">
                <a class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white" href="<?= url('/education/visual') ?>">Salud Visual</a>
            </div>
            <div class="px-5 py-2">
                <a class="text-base text-gray-500 hover:text-gray-900 dark:hover:text-white" href="<?= url('/support/contact') ?>">Soporte</a>
            </div>
        </nav>
        
        <div class="mt-8 flex justify-center space-x-6">
            <a class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300" href="#" aria-label="GitHub">
                <i class="fab fa-github text-xl"></i>
            </a>
        </div>
        
        <p class="mt-8 text-center text-base text-gray-400">
            &copy; <?= date('Y') ?> <?= APP_NAME ?> Platform. Todos los derechos reservados.
        </p>
    </div>
</footer>

<!-- Dark mode: detectar preferencia del sistema -->
<script>
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
    }
</script>
</body>
</html>
