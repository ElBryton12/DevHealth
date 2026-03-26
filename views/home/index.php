<?php
/**
 * DevHealth - Landing Page (Pública)
 * Ubicación: views/home/index.php
 */
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../config/app.php';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?= APP_NAME ?> - Salud Ocupacional para Desarrolladores</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#4F46E5",
                        secondary: "#10B981",
                        "background-light": "#F9FAFB",
                        "background-dark": "#111827",
                        "surface-light": "#FFFFFF",
                        "surface-dark": "#1F2937",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style>
        html { scroll-behavior: smooth; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100 font-sans transition-colors duration-300">

    <nav class="sticky top-0 z-50 bg-surface-light/90 dark:bg-surface-dark/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <span class="material-icons-outlined text-primary text-3xl">monitor_heart</span>
                        <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white"><?= APP_NAME ?></span>
                    </div>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="#educacion" class="text-gray-500 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Educación</a>
                        <a href="#herramientas" class="text-gray-500 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Herramientas</a>
                        <a href="#soporte" class="text-gray-500 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Soporte</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="document.documentElement.classList.toggle('dark')" class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
                        <span class="material-icons-outlined">dark_mode</span>
                    </button>
                    <a href="<?= url('/auth/login') ?>" class="text-gray-500 dark:text-gray-300 hover:text-primary px-3 py-2 rounded-md text-sm font-medium hidden sm:block">Login</a>
                    <a href="<?= url('/auth/login?tab=register') ?>" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-md transition-all">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden pt-16 pb-20 lg:pt-24 lg:pb-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl mb-6">
                    <span class="block">Programa tu código,</span>
                    <span class="block text-primary">cuida tu cuerpo.</span>
                </h1>
                <p class="mt-4 max-w-md mx-auto text-base text-gray-500 dark:text-gray-400 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    La plataforma de salud ocupacional diseñada específicamente para estudiantes de informática y desarrolladores. Previene la fatiga visual y física con herramientas inteligentes.
                </p>
                <div class="mt-8 max-w-md mx-auto sm:flex sm:justify-center md:mt-10 gap-4">
                    <a href="<?= url('/auth/login?tab=register') ?>" class="w-full flex items-center justify-center px-8 py-3 rounded-lg text-white bg-primary hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition-transform transform hover:-translate-y-1 font-medium shadow-lg shadow-primary/20">
                        Comenzar
                    </a>
                    <a href="#educacion" class="mt-3 sm:mt-0 w-full flex items-center justify-center px-8 py-3 rounded-lg text-primary bg-indigo-100 dark:bg-gray-800 dark:text-white hover:bg-indigo-200 dark:hover:bg-gray-700 md:py-4 md:text-lg md:px-10 transition-transform transform hover:-translate-y-1 font-medium">
                        Aprender Más
                    </a>
                </div>
            </div>
        </div>
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-1/4 left-10 w-72 h-72 bg-purple-300 dark:bg-purple-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-1/3 right-10 w-72 h-72 bg-blue-300 dark:bg-blue-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-surface-dark transition-colors" id="herramientas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Funcionalidades clave</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">Herramientas para tu bienestar digital</p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
                    Todo lo que necesitas para mantenerte saludable mientras programas
                    durante largas sesiones.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-8 bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl group hover:border-primary/50 transition-all">
                    <div class="h-12 w-12 rounded-xl bg-primary text-white flex items-center justify-center mb-6 shadow-lg shadow-indigo-500/20">
                        <span class="material-icons-outlined">fitness_center</span>
                    </div>
                    <h3 class="text-xl font-bold dark:text-white mb-3">Generador de Rutinas</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6"> Crea pausas activas personalizadas basadas en tu tiempo de codificación. Genera ejercicios rápidos para estirar cuello, espalda y muñecas.</p>
                    <a href="<?= url('/auth/login') ?>" class="text-primary font-medium flex items-center">Pruébalo ahora <span class="material-icons-outlined text-sm ml-1">arrow_forward</span></a>
                </div>
                <div class="p-8 bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl group hover:border-secondary/50 transition-all">
                    <div class="h-12 w-12 rounded-xl bg-secondary text-white flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/20">
                        <span class="material-icons-outlined">menu_book</span>
                    </div>
                    <h3 class="text-xl font-bold dark:text-white mb-3">Guías Educativas</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Aprende sobre higiene postural correcta y salud visual. Guías completas para configurar tu estación de trabajo ideal.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <span class="material-icons-outlined text-green-500 mr-2 text-base" >check_circle</span>
                            Higiene Postural
                        </li>
                        <li class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <span class="material-icons-outlined text-green-500 mr-2 text-base">check_circle</span>
                            Salud Visual
                        </li>
                    </ul>
                    <a href="#educacion" class="text-secondary font-medium flex items-center">Leer guías <span class="material-icons-outlined text-sm ml-1">arrow_forward</span></a>
                </div>
                <div class="p-8 bg-background-light dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl group hover:border-blue-500/50 transition-all">
                    <div class="h-12 w-12 rounded-xl bg-blue-500 text-white flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20">
                        <span class="material-icons-outlined">insights</span>
                    </div>
                    <h3 class="text-xl font-bold dark:text-white mb-3">Seguimiento</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Accede a tu Dashboard personal para ver tu historial de rutinas completadas y descargar reportes en PDF de tu progreso semanal.</p>
                    <a href="<?= url('/auth/login') ?>" class="text-blue-500 font-medium flex items-center">Ir al Dashboard <span class="material-icons-outlined text-sm ml-1">arrow_forward</span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50 dark:bg-gray-900 transition-colors" id="educacion">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <div class="rounded-2xl overflow-hidden shadow-2xl bg-gradient-to-br from-indigo-500 to-purple-600 aspect-video flex items-center justify-center relative mb-10 lg:mb-0">
                <span
                  class="material-icons-outlined text-9xl text-white/20 absolute transform -translate-x-10"
                  >chair</span
                >
                <span
                  class="material-icons-outlined text-9xl text-white/40 absolute transform translate-x-10"
                  >visibility</span
                >
                <img
                    alt="Developer sitting with good posture"
                    class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-50"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBugmJx-tK8XBNTe1B_bHf7Xfl3lJ5QKGdKUp6suhL-MAZ7ldAm-WbzsE4aXGpIoEX9lRpxUqL40pIa-w0G-4yxdf1wjTzV-FUIT53T4WFN3-85jYKXsyk3kFoyyy6Gfg92A1xIBfwPt508KPd0l6n2QKVzvGIpdw3-qXOa6uSPGwqJvuAFmrrZtga0szKOu_9CE7fusYlXolPHCHMl4uNi8v24iXBvz-DerqKMUDK46D8FSJHvZWMogLSRY0Gq6tx_kcbXri9aNA"
                />
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl mb-6">No ignores las señales de tu cuerpo</h2>
                <p class="text-lg text-gray-500 dark:text-gray-300 mb-6">
                    El síndrome del túnel carpiano, la fatiga visual digital y el
                    dolor de espalda crónico son comunes en nuestra industria.
                    Wellness Dev te educa para prevenir antes que curar.
                </p>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-icons-outlined">visibility</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-white"> Salud Visual </h4>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                Técnicas como la regla 20-20-20 para reducir la fatiga
                                ocular causada por pantallas.
                            </p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-icons-outlined">accessibility_new</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-white"> Higiene Postural</h4>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                Ajustes ergonómicos para tu silla, escritorio y monitor para
                                mantener una columna sana.
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-surface-dark transition-colors" id="soporte">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">
                ¿Necesitas ayuda o tienes dudas?
            </h2>
            <p class="text-xl text-gray-500 dark:text-gray-400 mb-8">
                Nuestro equipo de soporte está listo para ayudarte con cualquier
                problema en la plataforma.
            </p>
            <div class="bg-background-light dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                <form class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="sm:col-span-2">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left"
                            for="email"
                            >Correo Electrónico</label
                        >
                        <div class="mt-1">
                            <input
                            autocomplete="email"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"
                            id="email"
                            name="email"
                            placeholder="tu@email.com"
                            type="email"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left"
                            for="message"
                            >Mensaje</label
                        >
                        <div class="mt-1">
                            <textarea
                            class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"
                            id="message"
                            name="message"
                            placeholder="¿Cómo podemos ayudarte?"
                            rows="4"
                            ></textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2 text-right">
                        <button
                            class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:w-auto"
                            type="submit"
                        >
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-surface-light dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center items-center gap-2 mb-4">
                <span class="material-icons-outlined text-primary">monitor_heart</span>
                <span class="font-bold text-xl dark:text-white"><?= APP_NAME ?></span>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">© 2026 DevHealth. Cuidando a quienes construyen el futuro.</p>
            <div class="mt-4 flex justify-center space-x-6">
                <a href="#educacion" class="text-gray-400 hover:text-primary text-sm">Educación</a>
                <a href="#herramientas" class="text-gray-400 hover:text-primary text-sm">Herramientas</a>
                <a href="#soporte" class="text-gray-400 hover:text-primary text-sm">Contacto</a>
            </div>
        </div>
    </footer>

</body>
</html>