<?php
/**
 * DevHealth - Página de Soporte
 * Ubicación: views/support/contact.php
 */

require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();

include_once __DIR__ . '/../layouts/head.php';
?>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-body min-h-screen flex flex-col transition-colors duration-200">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <?php include_once __DIR__ . '/../layouts/navbar.php'; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <?php include_once __DIR__ . '/../layouts/flash.php'; ?>
    </div>

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white shadow-lg mb-4">
                        <span class="material-icons text-2xl">contact_support</span>
                    </span>
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        ¿Cómo podemos ayudarte?
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                        Tu salud y bienestar son nuestra prioridad. Si tienes dudas sobre los ejercicios, problemas técnicos o sugerencias, estamos aquí para escucharte.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                        <div class="flex items-center mb-3">
                            <span class="material-icons text-primary mr-2">email</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Email</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Consultas generales</p>
                        <a class="text-primary hover:text-primary-hover font-medium" href="mailto:soporte@devhealth.com">soporte@devhealth.com</a>
                    </div>
                    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                        <div class="flex items-center mb-3">
                            <span class="material-icons text-primary mr-2">help_outline</span>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">FAQ</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Preguntas frecuentes</p>
                        <a class="text-primary hover:text-primary-hover font-medium" href="#">Ir al centro de ayuda →</a>
                    </div>
                </div>

                <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-primary p-4 rounded-r-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <span class="material-icons text-primary">info</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                <strong>Tip del día:</strong> Ajusta el brillo de tu monitor al nivel de la luz ambiental para reducir la fatiga visual.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-surface-light dark:bg-surface-dark py-8 px-6 sm:px-10 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
                <form action="<?= url('/support/send') ?>" class="space-y-6" method="POST">
                    <?= csrfField() ?>

                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Formulario de Contacto</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="first-name">Nombre</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-icons text-gray-400 text-sm">person</span>
                                </div>
                                <input type="text" name="first_name" id="first-name" 
                                    value="<?= $user ? e($user['first_name']) : '' ?>"
                                    class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white py-2" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="last-name">Apellido</label>
                            <div class="mt-1">
                                <input type="text" name="last_name" id="last-name" 
                                    value="<?= $user ? e($user['last_name']) : '' ?>"
                                    class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white py-2" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Correo Electrónico</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-sm">email</span>
                            </div>
                            <input type="email" name="email" id="email" 
                                value="<?= $user ? e($user['email']) : '' ?>"
                                class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white py-2" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="category">Categoría</label>
                        <select name="category" id="category" class="mt-1 focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white py-2">
                            <option value="tecnico">Problema Técnico</option>
                            <option value="sugerencia">Sugerencia de Ejercicios</option>
                            <option value="general">Consulta General</option>
                            <option value="bug">Reporte de Bug</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="message">Mensaje</label>
                        <textarea id="message" name="message" rows="4" required
                            class="mt-1 focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white py-2 px-3" 
                            placeholder="Describe tu consulta detalladamente..."></textarea>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded dark:bg-gray-800 dark:border-gray-600">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700 dark:text-gray-300">Acepto la <a href="#" class="text-primary hover:text-primary-hover">política de privacidad</a></label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                            Enviar Mensaje
                            <span class="material-icons ml-2 text-sm">send</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>

    <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
             document.documentElement.classList.add('dark');
        }
    </script>

</body>
</html>
