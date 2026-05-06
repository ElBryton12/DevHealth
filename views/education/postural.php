<?php
/**
 * DevHealth - Educación: Higiene Postural
 * Ubicación: views/education/postural.php
 */

require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();

include_once __DIR__ . '/../layouts/head.php';
?>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans antialiased transition-colors duration-300">

    <?php include_once __DIR__ . '/../layouts/navbar.php'; ?>

    <header class="relative overflow-hidden bg-surface-light dark:bg-surface-dark py-16 sm:py-24">
        <div class="absolute inset-0 opacity-10 dark:opacity-20 pointer-events-none">
            <svg class="h-full w-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="url(#grad1)"></path>
                <defs>
                    <linearGradient id="grad1" x1="0%" x2="100%" y1="0%" y2="0%">
                        <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1"></stop>
                        <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:1"></stop>
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-4">
                    <span class="material-icons-outlined text-sm mr-1">school</span> Módulo Educativo
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6">
                    Higiene Postural para <span class="gradient-text">Developers</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                    Tu carrera no debería costarte tu salud. Aprende a configurar tu espacio de trabajo para prevenir el dolor de espalda y la fatiga visual.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#setup-guide" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-dark transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Comenzar Guía Interactiva
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <section id="setup-guide" class="mb-20 scroll-mt-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Configuración del Setup</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    El 90% de las molestias provienen de un equipo mal ajustado. Revisa punto por punto tu estación.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="aspect-w-4 aspect-h-3 relative rounded-xl overflow-hidden bg-surface-light dark:bg-surface-dark flex items-center justify-center min-h-[400px]">
                        <img alt="Setup de escritorio ergonómico con monitor, silla y teclado bien posicionados" class="object-cover w-full h-full opacity-90 hover:opacity-100 transition-opacity duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBcunAk8EbVIpa91yRrPvl6ugAWDJNeHH9vuVXR8i7sU5qhvYQMU2BDK1bVTsnvhXx1tU29sDYenih_fXAEpEQ4UMUerr_HNQUnjocmFiVtQ6ZuWutXb442vZX81rL-Tv6xJmt9cIsOlQ8aE8fxRSifq4_F_WUklpplU7Qf-nhpET7Uy3vOJvNj2XFYt9MPXZVw_4iX46GX-sBUXVWLddgcplT4OtF8HekUqduy6Njp-qgzVNdRjnOIgN_TL5G66niPTMspURERkQ"/>

                        <div class="absolute top-[30%] left-[50%] transform -translate-x-1/2 w-8 h-8 rounded-full bg-primary/80 animate-pulse border-2 border-white cursor-pointer group hover:bg-primary transition-colors">
                            <div class="absolute w-64 bg-surface-light dark:bg-surface-dark p-4 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 bottom-10 left-1/2 transform -translate-x-1/2 text-sm z-20 pointer-events-none border border-gray-200 dark:border-gray-600">
                                <h4 class="font-bold text-primary mb-1">Altura del Monitor</h4>
                                <p class="text-gray-600 dark:text-gray-300">El borde superior debe estar al nivel de tus ojos para mantener el cuello neutral.</p>
                            </div>
                        </div>

                        <div class="absolute bottom-[20%] left-[50%] transform -translate-x-1/2 w-8 h-8 rounded-full bg-primary/80 animate-pulse border-2 border-white cursor-pointer group hover:bg-primary transition-colors">
                            <div class="absolute w-64 bg-surface-light dark:bg-surface-dark p-4 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 bottom-10 left-1/2 transform -translate-x-1/2 text-sm z-20 pointer-events-none border border-gray-200 dark:border-gray-600">
                                <h4 class="font-bold text-primary mb-1">Posición del Teclado</h4>
                                <p class="text-gray-600 dark:text-gray-300">Codos a 90 grados. Las muñecas deben flotar o descansar suavemente, no doblarse.</p>
                            </div>
                        </div>

                        <div class="absolute bottom-[10%] left-[20%] w-8 h-8 rounded-full bg-primary/80 animate-pulse border-2 border-white cursor-pointer group hover:bg-primary transition-colors">
                            <div class="absolute w-64 bg-surface-light dark:bg-surface-dark p-4 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 bottom-10 left-1/2 transform -translate-x-1/2 text-sm z-20 pointer-events-none border border-gray-200 dark:border-gray-600">
                                <h4 class="font-bold text-primary mb-1">Soporte Lumbar</h4>
                                <p class="text-gray-600 dark:text-gray-300">Asegúrate de que la curva baja de tu espalda esté apoyada firmemente contra el respaldo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center space-x-6 text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center"><span class="w-3 h-3 bg-primary rounded-full mr-2"></span>Puntos de atención</span>
                        <span class="flex items-center"><span class="material-icons-outlined text-base mr-1">touch_app</span>Pasa el mouse para ver detalles</span>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-colors cursor-pointer group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                                <span class="material-icons-outlined text-blue-600 dark:text-blue-400">desktop_windows</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">Altura del Monitor</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Coloca tu monitor a una distancia de un brazo (45-70cm). La parte superior de la pantalla debe estar a la altura de tus ojos o ligeramente por debajo. Si usas laptop, ¡es obligatorio un soporte elevador!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-colors cursor-pointer group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-3 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors">
                                <span class="material-icons-outlined text-green-600 dark:text-green-400">chair_alt</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">Silla Ergonómica</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Tus pies deben tocar el suelo completamente. Las rodillas deben formar un ángulo de 90° o ligeramente mayor. El respaldo debe seguir la curvatura natural de tu columna.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-colors cursor-pointer group">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                                <span class="material-icons-outlined text-purple-600 dark:text-purple-400">keyboard</span>
                            </div>
                                <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">Teclado y Mouse</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Mantén el teclado plano o con inclinación negativa. El mouse debe estar cerca del teclado para evitar estirar el hombro. Usa atajos de teclado para reducir el uso del mouse.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="border-t border-gray-200 dark:border-gray-700 my-16"></div>
        <section class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-10 text-center">Correcto vs Incorrecto</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-red-50 dark:bg-red-900/10 rounded-2xl border border-red-200 dark:border-red-900 overflow-hidden">
                    <div class="h-64 bg-gray-200 dark:bg-gray-700 relative overflow-hidden group">
                        <img alt="Persona trabajando encorvada frente a una laptop en un sofá, ejemplo de mala postura" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfuigIeOt7YmySF7aJG53M1uFZbkbVdaWZNUYGnMywY54RgERoEzzp-y4Nr1w-44rncuGWgGwWOddv05pEl8lR1AjlvDtwtG4NCBA-zih__9a8u0AbCNANuUfNgcuKPkJKcYtgpEmDxgJ-BM10LRTKXw2rlKLb0wj-QOXu9b_OpS0n2Nwrrj8BoCxtuU1_mw0lr8XLFW2lgOgLx2EEMzwgtzekoUnPWs7zkdjK22qOgFIQuxAhnrgyd5FZU3kUox-gUvwkZBJWgg"/>
                        <div class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full shadow-lg">
                            <span class="material-icons-outlined">close</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-red-700 dark:text-red-400 mb-3 flex items-center">
                            <span class="material-icons-outlined mr-2">warning</span> Evita esto
                        </h3>
                        <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                            <li class="flex items-start">
                                <span class="material-icons-outlined text-red-500 text-sm mt-1 mr-2">cancel</span>
                                <span>Trabajar desde el sofá o cama encorvado ("Turtle neck").</span>
                            </li>
                            <li class="flex items-start">
                                <span class="material-icons-outlined text-red-500 text-sm mt-1 mr-2">cancel</span>
                                <span>Pies colgando o cruzados por mucho tiempo.</span>
                            </li>
                                <li class="flex items-start">
                                <span class="material-icons-outlined text-red-500 text-sm mt-1 mr-2">cancel</span>
                                <span>Mirar hacia abajo a la pantalla de la laptop.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bg-green-50 dark:bg-green-900/10 rounded-2xl border border-green-200 dark:border-green-900 overflow-hidden">
                    <div class="h-64 bg-gray-200 dark:bg-gray-700 relative overflow-hidden group">
                        <img alt="Persona sentada recta en escritorio limpio con postura ergonómica correcta" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDW63zy0Ra90GZagkVnW-EeSUbVtJU5s0uZCP9JHR-9j3NU06NDcZou2btw6G3egOlPFFbgjro74dI45aLFmixS_cXEBAxacEAY6AfgpyjIxPb3UJGQZ4FEn--8041yvubgEdnvdeuMGGRjPdoMKDIq81oaXTCslAMg50y5cZcprFUrdGemq1CrJ0eWcuATndGInRBR6VDrMwNAHs55jYoUuguTY5r-SfNRaUuDkr9FIeBsyOB1UOIE1Cgh81qXlpOad3dMxE4VA"/>
                        <div class="absolute top-4 right-4 bg-green-500 text-white p-2 rounded-full shadow-lg">
                            <span class="material-icons-outlined">check</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-green-700 dark:text-green-400 mb-3 flex items-center">
                            <span class="material-icons-outlined mr-2">verified</span> Haz esto
                        </h3>
                        <ul class="space-y-3 text-gray-700 dark:text-gray-300">
                            <li class="flex items-start">
                                <span class="material-icons-outlined text-green-500 text-sm mt-1 mr-2">check_circle</span>
                                <span>Espalda apoyada y hombros relajados.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="material-icons-outlined text-green-500 text-sm mt-1 mr-2">check_circle</span>
                                <span>Monitor a la altura de los ojos.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="material-icons-outlined text-green-500 text-sm mt-1 mr-2">check_circle</span>
                                <span>Tomar descansos activos cada 45-60 minutos.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="scroll-mt-24" id="health-tips">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Cuida tu cuerpo por partes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-md border-t-4 border-indigo-500 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg flex items-center justify-center mb-4">
                    <span class="material-icons-outlined text-indigo-600 dark:text-indigo-400 text-2xl">face</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Cuello</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                    La tensión cervical es común por inclinar la cabeza.
                </p>
                <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg text-sm text-gray-700 dark:text-gray-300 border border-gray-100 dark:border-gray-700">
                    <strong>Tip Pro:</strong> Cada hora, haz el movimiento de "doble papada" (retrae el mentón hacia atrás) 10 veces para realinear las vértebras.
                </div>
            </div>
            <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-md border-t-4 border-emerald-500 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg flex items-center justify-center mb-4">
                    <span class="material-icons-outlined text-emerald-600 dark:text-emerald-400 text-2xl">accessibility_new</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Espalda</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                        El dolor lumbar es la causa #1 de incapacidad en oficina.
                                    </p>
                <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg text-sm text-gray-700 dark:text-gray-300 border border-gray-100 dark:border-gray-700">
                <strong>Tip Pro:</strong> Levántate de la silla cada 30 minutos. Aunque sea solo para estirar los brazos hacia el techo durante 10 segundos.
                                    </div>
                </div>
                <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-md border-t-4 border-amber-500 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/50 rounded-lg flex items-center justify-center mb-4">
                        <span class="material-icons-outlined text-amber-600 dark:text-amber-400 text-2xl">pan_tool</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Muñecas</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        El síndrome del túnel carpiano es prevenible.
                    </p>
                    <div class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg text-sm text-gray-700 dark:text-gray-300 border border-gray-100 dark:border-gray-700">
                        <strong>Tip Pro:</strong> Estira los flexores y extensores de la mano antes de empezar a codificar. Usa un mouse vertical si sientes molestias.
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-24 rounded-3xl overflow-hidden relative bg-primary dark:bg-primary-dark shadow-2xl">
            <div class="absolute inset-0 opacity-20">
                <img alt="Fondo abstracto de oficina moderna" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvlrkeX7usuKdhuBSztRZbtVGlk9AXRxQI6JEE8d4GcxdBj8AELpk4Ja2aXcJJPipkKbG2_46n6pjXU0vPzr409wEamnsZuP8u2g_27DUjVcj5RHOpd0ZxrBl7QzqBv0fiiPOW-R6jKETmC0OWWkkr6Y-MrQMB5F1zYW3Iso9PpCfbbemx9nGVh4bMzNQfPESV5Gp6paO2OZ396sTL8bzCJoKK3iiiM2rpPyG-7TehEgh8e1U6jgaTfAgkFPFPcXdDOZ0LrLFr5Q"/>
            </div>
            <div class="relative z-10 py-16 px-6 sm:px-12 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between">
                <div class="mb-8 sm:mb-0 max-w-xl">
                    <h2 class="text-3xl font-bold text-white mb-4">¿Ya tienes dolores? No esperes más.</h2>
                    <p class="text-indigo-100 text-lg">
                        Utiliza nuestro <span class="font-semibold text-white">Generador de Rutinas</span> personalizado. Responde unas preguntas y obtén ejercicios específicos para tus síntomas.
                    </p>
                    </div>
                    <div>
                        <a href="<?= url('/routines/generator') ?>" class="bg-white text-primary font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-50 transition-colors transform hover:scale-105 inline-block">
                            Crear mi Rutina
                        </a>
                </div>
            </div>
        </section>

    </main>

    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>

</body>
</html>