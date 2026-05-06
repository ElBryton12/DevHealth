<?php
/**
 * DevHealth - Generador de Rutinas Inteligente
 * Convertida desde la maqueta de Google Stitch.
 */
$pageTitle = 'Generador de Rutinas';
require __DIR__ . '/../layouts/head.php';
?>


<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans min-h-screen flex flex-col antialiased">

<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<main class="flex-grow flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Blobs decorativos -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    
    <div class="max-w-4xl w-full space-y-8 relative z-10">
        <!-- Header -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center p-3 bg-primary/10 rounded-2xl mb-4">
                <span class="material-icons-round text-primary text-4xl">fitness_center</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                Generador de Rutinas
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Optimiza tu salud mientras programas. Cuéntanos cómo te sientes y crearemos una pausa activa personalizada para ti.
            </p>
        </div>

        <?php require __DIR__ . '/../layouts/flash.php'; ?>

        <!-- Formulario -->
        <form action="<?= url('/routines/generate') ?>" method="POST" id="routine-form"
              class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transition-colors duration-300">
            <?= csrfField() ?>
            
            <div class="p-8 md:p-10 space-y-10">
                
                <!-- PASO 1: Tiempo -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">1</span>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">¿De cuánto tiempo dispones?</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- 5 min -->
                        <label class="relative group cursor-pointer">
                            <input class="peer sr-only" name="duration" type="radio" value="5">
                            <div class="step-card h-full p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary/50 bg-white dark:bg-slate-800/50 peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <div class="flex flex-col items-center text-center space-y-3">
                                    <span class="material-icons-round text-3xl text-gray-400 peer-checked:text-primary transition-colors">timer</span>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Rápida</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">5 Minutos</p>
                                    <span class="text-xs text-primary font-medium bg-primary/10 px-2 py-1 rounded-full mt-2">Pausa Corta</span>
                                </div>
                            </div>
                            <div class="absolute -top-2 -right-2 hidden peer-checked:block bg-primary text-white rounded-full p-1 shadow-lg">
                                <span class="material-icons-round text-sm">check</span>
                            </div>
                        </label>
                        <!-- 10 min (default) -->
                        <label class="relative group cursor-pointer">
                            <input class="peer sr-only" name="duration" type="radio" value="10" checked>
                            <div class="step-card h-full p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary/50 bg-white dark:bg-slate-800/50 peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <div class="flex flex-col items-center text-center space-y-3">
                                    <span class="material-icons-round text-3xl text-gray-400 peer-checked:text-primary transition-colors">hourglass_top</span>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Estándar</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">10 Minutos</p>
                                    <span class="text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 px-2 py-1 rounded-full mt-2">Recomendada</span>
                                </div>
                            </div>
                            <div class="absolute -top-2 -right-2 hidden peer-checked:block bg-primary text-white rounded-full p-1 shadow-lg">
                                <span class="material-icons-round text-sm">check</span>
                            </div>
                        </label>
                        <!-- 15 min -->
                        <label class="relative group cursor-pointer">
                            <input class="peer sr-only" name="duration" type="radio" value="15">
                            <div class="step-card h-full p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-primary/50 bg-white dark:bg-slate-800/50 peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <div class="flex flex-col items-center text-center space-y-3">
                                    <span class="material-icons-round text-3xl text-gray-400 peer-checked:text-primary transition-colors">timelapse</span>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Completa</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">15 Minutos</p>
                                    <span class="text-xs text-gray-500 font-medium bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full mt-2">Relajación Total</span>
                                </div>
                            </div>
                            <div class="absolute -top-2 -right-2 hidden peer-checked:block bg-primary text-white rounded-full p-1 shadow-lg">
                                <span class="material-icons-round text-sm">check</span>
                            </div>
                        </label>
                    </div>
                </section>

                <!-- PASO 2: Zonas de dolor -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">2</span>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">¿Sientes molestia en alguna zona?</h2>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="pain_areas[]" type="checkbox" value="neck">
                            <div class="step-card h-full flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-800/30 hover:bg-white dark:hover:bg-slate-800 hover:shadow-md peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <span class="material-icons-round text-4xl mb-2 text-gray-400 group-hover:text-primary peer-checked:text-primary">accessibility_new</span>
                                <span class="font-medium text-gray-700 dark:text-gray-200">Cuello</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="pain_areas[]" type="checkbox" value="back">
                            <div class="step-card h-full flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-800/30 hover:bg-white dark:hover:bg-slate-800 hover:shadow-md peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <span class="material-icons-round text-4xl mb-2 text-gray-400 group-hover:text-primary peer-checked:text-primary">airline_seat_recline_normal</span>
                                <span class="font-medium text-gray-700 dark:text-gray-200">Espalda Baja</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="pain_areas[]" type="checkbox" value="wrists">
                            <div class="step-card h-full flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-800/30 hover:bg-white dark:hover:bg-slate-800 hover:shadow-md peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <span class="material-icons-round text-4xl mb-2 text-gray-400 group-hover:text-primary peer-checked:text-primary">pan_tool</span>
                                <span class="font-medium text-gray-700 dark:text-gray-200">Muñecas</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input class="peer sr-only" name="pain_areas[]" type="checkbox" value="eyes">
                            <div class="step-card h-full flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-800/30 hover:bg-white dark:hover:bg-slate-800 hover:shadow-md peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 peer-checked:ring-1 peer-checked:ring-primary transition-all">
                                <span class="material-icons-round text-4xl mb-2 text-gray-400 group-hover:text-primary peer-checked:text-primary">visibility</span>
                                <span class="font-medium text-gray-700 dark:text-gray-200">Vista Cansada</span>
                            </div>
                        </label>
                    </div>
                </section>

                <!-- PASO 3: Intensidad -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-sm">3</span>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Nivel de intensidad</h2>
                    </div>
                    <div class="px-2">
                        <input class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 accent-primary"
                               id="intensity-slider" name="intensity" type="range" min="1" max="3" value="2">
                        <div class="flex justify-between mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>Suave</span>
                            <span>Moderado</span>
                            <span>Activo</span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer del formulario -->
            <div class="px-8 md:px-10 py-6 bg-gray-50 dark:bg-slate-800/50 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center sm:text-left">
                    Basado en tus selecciones, generaremos una rutina de 
                    <span class="font-semibold text-primary" id="duration-display">10 minutos</span> enfocada en alivio.
                </p>
                <button type="submit" 
                        class="w-full sm:w-auto px-8 py-3 bg-primary hover:bg-primary-hover text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-icons-round">bolt</span>
                    Generar Rutina
                </button>
            </div>
        </form>

        <!-- Links inferiores -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500 dark:text-gray-400">
            <a class="flex items-center gap-2 hover:text-primary transition-colors p-3 rounded-lg hover:bg-surface-light dark:hover:bg-surface-dark/50" 
               href="<?= url('/routines/history') ?>">
                <span class="material-icons-round text-lg">history</span>
                Ver historial de rutinas
            </a>
            <a class="flex items-center gap-2 hover:text-primary transition-colors p-3 rounded-lg hover:bg-surface-light dark:hover:bg-surface-dark/50 md:justify-end" 
               href="<?= url('/education/postural') ?>">
                <span class="material-icons-round text-lg">help_outline</span>
                ¿Cómo funciona?
            </a>
        </div>
    </div>
</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

<script>
// Actualizar texto de duración dinámicamente
document.querySelectorAll('input[name="duration"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('duration-display').textContent = this.value + ' minutos';
    });
});
</script>
