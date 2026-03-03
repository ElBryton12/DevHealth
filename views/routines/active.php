<?php
/**
 * DevHealth - Tu Rutina de Pausa Activa
 * Convertida desde la maqueta your_active_break_routine.html
 */
$pageTitle = 'Tu Rutina Activa';
require __DIR__ . '/../layouts/head.php';

// Mapeo de colores a clases Tailwind
$colorMap = [
    'green'   => ['bg' => 'bg-green-100 dark:bg-green-900/30',  'text' => 'text-green-600 dark:text-green-200',  'badge' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'],
    'emerald' => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-600 dark:text-emerald-200', 'badge' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200'],
    'yellow'  => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-600 dark:text-yellow-200', 'badge' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'],
    'orange'  => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-600 dark:text-orange-200', 'badge' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200'],
    'red'     => ['bg' => 'bg-red-100 dark:bg-red-900/30',    'text' => 'text-red-500 dark:text-red-300',    'badge' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'],
    'rose'    => ['bg' => 'bg-rose-100 dark:bg-rose-900/30',   'text' => 'text-rose-500 dark:text-rose-300',  'badge' => 'bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-200'],
    'blue'    => ['bg' => 'bg-blue-100 dark:bg-blue-900/30',   'text' => 'text-blue-600 dark:text-blue-200',  'badge' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'],
    'indigo'  => ['bg' => 'bg-indigo-100 dark:bg-indigo-900/30', 'text' => 'text-indigo-600 dark:text-indigo-200', 'badge' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200'],
    'teal'    => ['bg' => 'bg-teal-100 dark:bg-teal-900/30',   'text' => 'text-teal-600 dark:text-teal-200',  'badge' => 'bg-teal-100 text-teal-800 dark:bg-teal-900 dark:text-teal-200'],
    'cyan'    => ['bg' => 'bg-cyan-100 dark:bg-cyan-900/30',   'text' => 'text-cyan-600 dark:text-cyan-200',  'badge' => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200'],
    'sky'     => ['bg' => 'bg-sky-100 dark:bg-sky-900/30',    'text' => 'text-sky-600 dark:text-sky-200',   'badge' => 'bg-sky-100 text-sky-800 dark:bg-sky-900 dark:text-sky-200'],
    'violet'  => ['bg' => 'bg-violet-100 dark:bg-violet-900/30', 'text' => 'text-violet-600 dark:text-violet-200', 'badge' => 'bg-violet-100 text-violet-800 dark:bg-violet-900 dark:text-violet-200'],
    'amber'   => ['bg' => 'bg-amber-100 dark:bg-amber-900/30',  'text' => 'text-amber-600 dark:text-amber-200',  'badge' => 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200'],
    'lime'    => ['bg' => 'bg-lime-100 dark:bg-lime-900/30',   'text' => 'text-lime-600 dark:text-lime-200',  'badge' => 'bg-lime-100 text-lime-800 dark:bg-lime-900 dark:text-lime-200'],
];

$exercises = $routine['exercises'] ?? [];
$focusLabel = '';
$painLabels = ['neck' => 'Cuello', 'back' => 'Espalda', 'wrists' => 'Muñecas', 'eyes' => 'Fatiga Visual', 'visual' => 'Fatiga Visual', 'postural' => 'Postura', 'mixed' => 'General'];
$focusLabel = $painLabels[$routine['focus_area']] ?? 'General';
$intensityLabel = Routine::intensityLabel($routine['difficulty']);
?>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans min-h-screen flex flex-col transition-colors duration-200">

<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 flex-1">
    
    <!-- Header -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl">
                Tu Rutina Generada
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Enfoque: <span class="font-medium text-primary"><?= e($routine['title']) ?></span>
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4 gap-3">
            <a href="<?= url('/routines/generator') ?>" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <span class="material-icons-round mr-2 text-sm">refresh</span>
                Regenerar
            </a>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-10">
        <div class="bg-surface-light dark:bg-surface-dark overflow-hidden shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:p-6 flex items-center">
                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-md p-3">
                    <span class="material-icons-round text-blue-600 dark:text-blue-200">schedule</span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Duración Total</dt>
                    <dd class="text-2xl font-semibold text-gray-900 dark:text-white"><?= e($routine['duration_min']) ?> Minutos</dd>
                </div>
            </div>
        </div>
        <div class="bg-surface-light dark:bg-surface-dark overflow-hidden shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:p-6 flex items-center">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-md p-3">
                    <span class="material-icons-round text-green-600 dark:text-green-200">accessibility_new</span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Ejercicios</dt>
                    <dd class="text-2xl font-semibold text-gray-900 dark:text-white"><?= count($exercises) ?> Movimientos</dd>
                </div>
            </div>
        </div>
        <div class="bg-surface-light dark:bg-surface-dark overflow-hidden shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-5 sm:p-6 flex items-center">
                <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900/30 rounded-md p-3">
                    <span class="material-icons-round text-purple-600 dark:text-purple-200">trending_up</span>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Nivel de Intensidad</dt>
                    <dd class="text-2xl font-semibold text-gray-900 dark:text-white"><?= e($intensityLabel) ?></dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Ejercicios -->
    <div class="space-y-6">
        <?php foreach ($exercises as $idx => $exercise): 
            $color = $exercise['color'] ?? 'blue';
            $classes = $colorMap[$color] ?? $colorMap['blue'];
        ?>
        <div class="bg-surface-light dark:bg-surface-dark shadow sm:rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row">
            <!-- Icono lateral -->
            <div class="md:w-1/3 bg-gray-50 dark:bg-gray-800/50 flex items-center justify-center p-6 border-b md:border-b-0 md:border-r border-gray-200 dark:border-gray-700 relative">
                <span class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-2 py-1 rounded">Paso <?= $exercise['step'] ?></span>
                <div class="w-32 h-32 rounded-full <?= $classes['bg'] ?> flex items-center justify-center">
                    <span class="material-icons-round text-6xl <?= $classes['text'] ?>"><?= e($exercise['icon']) ?></span>
                </div>
            </div>
            <!-- Contenido -->
            <div class="p-6 md:w-2/3 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white"><?= e($exercise['name']) ?></h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $classes['badge'] ?>">
                            <?= e($exercise['zone']) ?>
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <?= e($exercise['description']) ?>
                    </p>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-icons-round text-gray-400 dark:text-gray-500">timer</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white"><?= e($exercise['duration_label']) ?></span>
                    </div>
                    <button type="button" 
                            class="timer-btn text-primary hover:text-primary-hover font-medium text-sm flex items-center group"
                            data-duration="<?= (int)$exercise['duration'] ?>"
                            data-step="<?= $exercise['step'] ?>">
                        <span class="timer-text">Iniciar Temporizador</span>
                        <span class="material-icons-round ml-1 group-hover:translate-x-1 transition-transform text-sm">play_arrow</span>
                    </button>
                </div>
                <!-- Barra de progreso del timer -->
                <div class="mt-3 hidden timer-bar" id="timer-bar-<?= $exercise['step'] ?>">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full transition-all duration-1000" style="width: 0%" id="timer-progress-<?= $exercise['step'] ?>"></div>
                    </div>
                    <p class="text-xs text-center mt-1 text-gray-500 dark:text-gray-400" id="timer-countdown-<?= $exercise['step'] ?>"></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- CTA Final -->
    <div class="mt-10 flex flex-col items-center justify-center gap-4 py-8 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">¿Completaste la rutina?</h3>
        <div class="flex gap-4">
            <a href="<?= url('/routines/complete/' . $routine['id']) ?>" 
               class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-primary hover:bg-primary-hover transition-colors">
                <span class="material-icons-round mr-2">check_circle</span>
                Marcar como Completada
            </a>
            <a href="<?= url('/routines/generator') ?>" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 shadow-sm text-base font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <span class="material-icons-round mr-2">refresh</span>
                Generar Otra
            </a>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
            Al marcar como completada se registra en tu historial y estadísticas.
        </p>
    </div>
</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

<script>
// Sistema de temporizadores por ejercicio
document.querySelectorAll('.timer-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const duration = parseInt(this.dataset.duration);
        const step = this.dataset.step;
        const bar = document.getElementById('timer-bar-' + step);
        const progress = document.getElementById('timer-progress-' + step);
        const countdown = document.getElementById('timer-countdown-' + step);
        
        // Mostrar barra
        bar.classList.remove('hidden');
        this.disabled = true;
        this.querySelector('.timer-text').textContent = 'En curso...';
        
        let elapsed = 0;
        const interval = setInterval(() => {
            elapsed++;
            const pct = Math.min((elapsed / duration) * 100, 100);
            progress.style.width = pct + '%';
            countdown.textContent = (duration - elapsed) + 's restantes';
            
            if (elapsed >= duration) {
                clearInterval(interval);
                progress.style.width = '100%';
                progress.classList.remove('bg-primary');
                progress.classList.add('bg-green-500');
                countdown.textContent = '¡Completado!';
                this.querySelector('.timer-text').textContent = '¡Hecho!';
                this.classList.remove('text-primary');
                this.classList.add('text-green-500');
            }
        }, 1000);
    });
});
</script>
