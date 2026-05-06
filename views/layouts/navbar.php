<?php $user = currentUser(); ?>
<nav class="sticky top-0 z-50 bg-surface-light/80 dark:bg-surface-dark/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?= url('/dashboard') ?>" class="flex-shrink-0 flex items-center gap-2">
                    <span class="bg-primary p-2 rounded-lg text-white">
                        <span class="material-icons-round text-xl">health_and_safety</span>
                    </span>
                    <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white"><?= APP_NAME ?></span>
                </a>

                <!-- Links desktop -->
                <div class="hidden md:ml-8 md:flex md:space-x-8 items-center">
                    <a href="<?= url('/dashboard') ?>"
                       class="<?= isRoute('/dashboard') ? 'border-b-2 border-primary text-gray-900 dark:text-white' : 'border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="<?= url('/routines/generator') ?>"
                       class="<?= isRoute('/routines/generator') ? 'border-b-2 border-primary text-gray-900 dark:text-white' : 'border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Rutinas
                    </a>
                    <a href="<?= url('/education/postural') ?>"
                       class="<?= (isRoute('/education/postural') || isRoute('/education/visual')) ? 'border-b-2 border-primary text-gray-900 dark:text-white' : 'border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Educación
                    </a>
                    <a href="<?= url('/routines/history') ?>"
                       class="<?= isRoute('/routines/history') ? 'border-b-2 border-primary text-gray-900 dark:text-white' : 'border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' ?> inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Historial
                    </a>
                </div>
            </div>

            <!-- Acciones del usuario -->
            <div class="flex items-center gap-4">
                <!-- Toggle dark/light mode con persistencia -->
                <button id="theme-toggle"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 focus:outline-none"
                        title="Cambiar tema">
                    <span class="material-icons-round" id="theme-icon">dark_mode</span>
                </button>

                <!-- Avatar y menú usuario -->
                <div class="relative">
                    <button class="flex items-center gap-2 focus:outline-none" id="user-menu-btn">
                        <div class="h-9 w-9 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm ring-2 ring-primary/20">
                            <?php if ($user): ?>
                                <?= e(User::getInitials($user)) ?>
                            <?php else: ?>
                                ??
                            <?php endif; ?>
                        </div>
                        <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-200">
                            <?= $user ? e($user['first_name']) : 'Usuario' ?>
                        </span>
                    </button>

                    <!-- Dropdown -->
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-surface-light dark:bg-surface-dark rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50">
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                <?= $user ? e($user['first_name'] . ' ' . $user['last_name']) : '' ?>
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                <?= $user ? e($user['email']) : '' ?>
                            </p>
                        </div>
                        <a href="<?= url('/support/contact') ?>" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="material-icons-round text-sm mr-2 align-middle">help_outline</span>
                            Soporte
                        </a>
                        <a href="<?= url('/auth/logout') ?>" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="material-icons-round text-sm mr-2 align-middle">logout</span>
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>

            <!-- Botón menú móvil -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-btn" class="p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="material-icons-round">menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-700">
        <div class="px-4 py-3 space-y-1">
            <a href="<?= url('/dashboard') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
            <a href="<?= url('/routines/generator') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Rutinas</a>
            <a href="<?= url('/education/postural') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Educación</a>
            <a href="<?= url('/routines/history') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Historial</a>
            <hr class="border-gray-200 dark:border-gray-700">
            <a href="<?= url('/auth/logout') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<script>
(function() {
    // Sincronizar ícono con el estado actual al cargar
    var isDark = document.documentElement.classList.contains('dark');
    var icon = document.getElementById('theme-icon');
    if (icon) icon.textContent = isDark ? 'light_mode' : 'dark_mode';

    // Toggle con persistencia en localStorage
    document.getElementById('theme-toggle')?.addEventListener('click', function() {
        isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('devhealth_theme', isDark ? 'dark' : 'light');
        var icon = document.getElementById('theme-icon');
        if (icon) icon.textContent = isDark ? 'light_mode' : 'dark_mode';
    });

    // Dropdown usuario
    document.getElementById('user-menu-btn')?.addEventListener('click', function() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    });

    // Menú móvil
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Cerrar dropdown al hacer click fuera
    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('user-dropdown');
        var btn = document.getElementById('user-menu-btn');
        if (dropdown && btn && !dropdown.contains(e.target) && !btn.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
})();
</script>
