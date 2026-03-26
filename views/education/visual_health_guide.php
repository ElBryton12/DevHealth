<?php
/**
 * DevHealth - Educación: Salud Visual
 * Ubicación: views/education/visual_health_guide.php
 */

require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();

// Incluimos el <head> global
include_once __DIR__ . '/../layouts/head.php';
?>

<style>
    .glass-panel {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    /* Estilo para el subrayado animado del título */
    .underline-svg {
        filter: drop-shadow(0px 2px 2px rgba(99, 102, 241, 0.4));
    }
</style>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark transition-colors duration-300 min-h-screen flex flex-col">

    <?php include_once __DIR__ . '/../layouts/navbar.php'; ?>

    <header class="relative pt-16 pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-primary/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-400/10 blur-3xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 text-sm font-medium mb-6 border border-blue-100 dark:border-blue-800">
                <span class="material-icons-round text-sm">school</span>
                Módulo Educativo
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 tracking-tight leading-tight">
                Protege tu <span class="text-primary relative inline-block">Visión
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-primary opacity-30 underline-svg" fill="none" viewBox="0 0 200 9" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00025 6.99999C25.5966 3.65171 58.6256 1.48742 85.3582 1.05602C116.31 0.556488 153.308 1.1542 197.999 5.00002" stroke="currentColor" stroke-linecap="round" stroke-width="3"></path>
                    </svg>
                </span> mientras programas
            </h1>
            
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                El Síndrome Visual Informático afecta al 90% de los desarrolladores. Aprende técnicas simples para prevenir la fatiga ocular y mantener tu rendimiento.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?= url('/routines/generator') ?>" class="flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-medium transition-all shadow-lg shadow-primary/25">
                    Empezar Rutina Visual
                    <span class="material-icons-round">arrow_forward</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 space-y-24">
        
        <section>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-icons-round text-indigo-600 dark:text-indigo-400 text-3xl">timer</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">La Regla 20-20-20</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                        Cada <strong class="text-primary">20 minutos</strong>, mira algo a <strong class="text-primary">20 pies</strong> (6 metros) de distancia durante al menos <strong class="text-primary">20 segundos</strong>.
                    </p>
                    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg text-sm text-gray-500 dark:text-gray-400 italic">
                        "Esto relaja el músculo ciliar del ojo y reduce la fatiga de enfoque."
                    </div>
                </div>

                <div class="group bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-icons-round text-amber-600 dark:text-amber-400 text-3xl">light_mode</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3"> Iluminación Adecuada</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                        Evita trabajar a oscuras. La luz ambiental debe ser similar al brillo de tu pantalla. Evita reflejos directos en el monitor.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center gap-2"><span class="material-icons-round text-green-500 text-base">check</span> Usa luz cálida de fondo</li>
                        <li class="flex items-center gap-2"><span class="material-icons-round text-red-500 text-base">close</span> Evita luz directa a los ojos</li>
                    </ul>
                </div>

                <div class="group bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:shadow-primary/5 hover:border-primary/30 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-icons-round text-emerald-600 dark:text-emerald-400 text-3xl">desktop_windows</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Configuración de Pantalla</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                        La parte superior del monitor debe estar a la altura de los ojos o ligeramente por debajo. Mantén una distancia de un brazo (50-70cm).
                    </p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden mt-4">
                        <div class="bg-emerald-500 h-full w-3/4"></div>
                    </div>
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 block">Brillo recomendado: 75%</span>
                </div>
            </div>
        </section>

        <section class="relative bg-surface-light dark:bg-surface-dark rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-12 items-center">
                    <div class="md:w-1/2 space-y-6">
                        <div class="inline-flex items-center gap-2 text-primary font-semibold tracking-wide uppercase text-sm">
                            <span class="w-8 h-0.5 bg-primary rounded-full"></span>
                            Ejercicios Prácticos
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Yoga Ocular para el Desk</h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300">
                            Pequeños movimientos que puedes hacer sin levantarte de la silla para lubricar los ojos y relajar la tensión acumulada tras horas de código.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                                    <span class="material-icons-round">loop</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Rotación Circular</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gira los ojos en sentido horario 5 veces, luego antihorario.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                <div class="bg-purple-100 dark:bg-purple-900/50 p-2 rounded-lg text-purple-600 dark:text-purple-400">
                                    <span class="material-icons-round">close_fullscreen</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">Parpadeo Consciente</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cierra los ojos fuerte por 3 segundos, luego ábrelos grande. Repite 10 veces.</p>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <a class="inline-flex items-center text-primary font-semibold hover:text-primary-dark group" href="#">
                                Ver guía completa de ejercicios
                                <span class="material-icons-round ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2 relative">
                        <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-2xl shadow-inner flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 border-4 border-primary/20 rounded-full animate-pulse"></div>
                                <div class="absolute w-24 h-24 border-4 border-primary/40 rounded-full"></div>
                                <div class="absolute w-4 h-4 bg-primary rounded-full shadow-[0_0_20px_rgba(99,102,241,0.5)]"></div>
                            </div>
                            <img alt="Persona relajándose frente al ordenador con ejercicios oculares" class="absolute inset-0 w-full h-full object-cover opacity-80 mix-blend-overlay rounded-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzeajCUKirLR73DeS-R7ltyUD4bBtY5-_TQUkg8uM4UgoTE51Y3eMaEd5LMxja05Qfek-RewjsteDYMVI-1Ytp_M6J7EUsnZssCfnBxSOtjmPel8iCUFn0bseX3X3n2N3ulaL0pHAoX8cAFGJTlSLCfhb7GJXqVfwuxHEGWHDFNFqGmgVZwrgVnSMxFFyas8t9DY0qZOjW7qFcX0phx3yWKJ04zMImJnEWToysvP6-J7lDLf6w_KNnn6_VvBOYJKnXPMkTUDqJJg"/>
                            <div class="absolute bottom-4 right-4 bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-xs font-mono">
                                IMG: Eye Workout
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-center max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">¿Listo para mejorar tu entorno de trabajo?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Configura recordatorios personalizados y genera una rutina adaptada a tu horario de clases o trabajo.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?= url('/education/postural') ?>" class="inline-flex justify-center items-center gap-2 bg-surface-light dark:bg-surface-dark border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 px-6 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <span class="material-icons-round text-gray-400">chair</span>
                    Ver Higiene Postural
                </a>
                <a href="<?= url('/routines/generator') ?>" class="inline-flex justify-center items-center gap-2 bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-lg shadow-lg shadow-primary/25 transition-all">
                    <span class="material-icons-round">schedule</span>
                    Ir al generador de rutinas
                </a>
            </div>
        </section>

    </main>

    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>

</body>
</html>