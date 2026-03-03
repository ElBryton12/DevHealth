<?php
/**
 * DevHealth - Dashboard del Usuario
 * Datos reales desde la BD.
 */
$pageTitle = 'Dashboard';
$extraHead = '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
require __DIR__ . '/../layouts/head.php';

$focusIcons = [
    'visual'   => ['icon' => 'visibility',       'bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-600'],
    'postural' => ['icon' => 'accessibility_new', 'bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-600'],
    'mixed'    => ['icon' => 'fitness_center',    'bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-600'],
];
$statusBadges = [
    'completed'   => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    'generated'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
    'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
];
$statusLabels = [
    'completed'   => 'Completado',
    'generated'   => 'Generada',
    'in_progress' => 'En curso',
];
?>

<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans antialiased min-h-screen flex flex-col transition-colors duration-300">

<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<main class="flex-1 py-8">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php require __DIR__ . '/../layouts/flash.php'; ?>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Hola, <?= e($user['first_name']) ?> &#x1F44B;</h1>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Es hora de cuidar tu postura y tu vista. &#191;Listo para una pausa?</p>
        </div>
        <a href="<?= url('/routines/generator') ?>"
           class="bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-xl shadow-lg shadow-indigo-500/30 flex items-center gap-2 transition-all transform hover:scale-105 w-fit">
            <span class="material-icons-round">play_arrow</span>
            <span class="font-medium">Iniciar Rutina R&#225;pida</span>
        </a>
    </div>

    <!-- ======== STATS CARDS ======== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Pausas Activas -->
        <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pausas Activas (Semana)</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white"><?= $stats['weeklyCompleted'] ?></h3>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400">
                    <span class="material-icons-round">fitness_center</span>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <?php if ($stats['weeklyDiff'] >= 0): ?>
                <span class="text-green-500 font-medium flex items-center">
                    <span class="material-icons-round text-sm mr-1">trending_up</span>+<?= $stats['weeklyDiff'] ?>
                </span>
                <?php else: ?>
                <span class="text-red-500 font-medium flex items-center">
                    <span class="material-icons-round text-sm mr-1">trending_down</span><?= $stats['weeklyDiff'] ?>
                </span>
                <?php endif; ?>
                <span class="text-gray-400 ml-2">vs. semana pasada</span>
            </div>
        </div>

        <!-- Racha Diaria -->
        <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Racha Diaria</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        <?= $stats['streak'] ?> <span class="text-lg font-normal text-gray-500">d&#237;as</span>
                    </h3>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg text-orange-600 dark:text-orange-400">
                    <span class="material-icons-round">local_fire_department</span>
                </div>
            </div>
            <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                <div class="bg-orange-500 h-2 rounded-full transition-all" style="width: <?= min(($stats['streak'] / 7) * 100, 100) ?>%"></div>
            </div>
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Objetivo semanal: 7 d&#237;as</p>
        </div>

        <!-- Descansos Visuales -->
        <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Descansos Visuales</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white"><?= $stats['visualBreaks'] ?></h3>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                    <span class="material-icons-round">visibility</span>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-blue-500 font-medium">Recuerda</span>
                <span class="text-gray-400 ml-2">la regla 20-20-20</span>
            </div>
        </div>

        <!-- Tiempo Activo -->
        <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tiempo Activo</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        <?= $stats['activeMinutes'] ?> <span class="text-lg font-normal text-gray-500">min</span>
                    </h3>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
                    <span class="material-icons-round">timer</span>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-purple-500 font-medium"><?= $stats['totalCompleted'] ?> rutinas</span>
                <span class="text-gray-400 ml-2">completadas en total</span>
            </div>
        </div>
    </div>

    <!-- ======== GRAFICO + SIDEBAR ======== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

        <!-- Grafico -->
        <div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="material-icons-round text-primary">analytics</span>
                    Actividad Semanal
                </h2>
                <span class="text-sm text-gray-500 dark:text-gray-400">&#218;ltimos 7 d&#237;as</span>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="activityChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-4 text-center">
                <div class="bg-gray-50 dark:bg-gray-800/50 p-3 rounded-xl">
                    <p class="text-xs text-gray-500">Esta Semana</p>
                    <p class="font-bold text-gray-900 dark:text-white"><?= $stats['weeklyCompleted'] ?> rutinas</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 p-3 rounded-xl">
                    <p class="text-xs text-gray-500">Racha</p>
                    <p class="font-bold text-gray-900 dark:text-white"><?= $stats['streak'] ?> d&#237;as</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 p-3 rounded-xl">
                    <p class="text-xs text-gray-500">Tiempo Total</p>
                    <p class="font-bold text-gray-900 dark:text-white"><?= $stats['activeMinutes'] ?> min</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">

            <!-- Rutina sugerida -->
            <div class="bg-gradient-to-br from-primary to-indigo-700 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <h3 class="font-bold text-lg mb-2 relative z-10">Pr&#243;xima sesi&#243;n sugerida</h3>
                <p class="text-indigo-100 text-sm mb-4 relative z-10">
                    Basado en tu actividad, te recomendamos estirar el cuello y hombros.
                </p>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 flex items-center gap-3 mb-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <span class="material-icons-round text-white">timer</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Estiramiento Cervical</p>
                        <p class="text-xs text-indigo-200">5 minutos &#8226; Intensidad Baja</p>
                    </div>
                </div>
                <a href="<?= url('/routines/generator') ?>"
                   class="block w-full bg-white text-primary font-bold py-2.5 rounded-lg text-sm hover:bg-gray-50 transition-colors shadow-sm text-center">
                    Comenzar ahora
                </a>
            </div>

            <!-- Educacion -->
            <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-icons-round text-purple-500">school</span>
                    Educaci&#243;n Reciente
                </h3>
                <div class="space-y-4">
                    <a class="flex gap-4 group" href="<?= url('/education/postural') ?>">
                        <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-round text-primary text-2xl">airline_seat_recline_normal</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-primary transition-colors">Configura tu silla correctamente</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Higiene Postural &#8226; 3 min lectura</p>
                        </div>
                    </a>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <a class="flex gap-4 group" href="<?= url('/education/visual') ?>">
                        <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-icons-round text-green-600 text-2xl">visibility</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-primary transition-colors">S&#237;ndrome visual inform&#225;tico</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Salud Visual &#8226; 5 min lectura</p>
                        </div>
                    </a>
                </div>
                <a href="<?= url('/education/postural') ?>" class="block w-full mt-4 text-primary text-sm font-medium hover:underline text-center">
                    Ver todo el contenido
                </a>
            </div>
        </div>
    </div>

    <!-- ======== TABLA ACTIVIDAD RECIENTE ======== -->
    <div class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Actividad Reciente</h2>
            <a href="<?= url('/routines/generator') ?>" class="text-sm text-primary hover:text-primary-hover font-medium">Ver historial completo</a>
        </div>

        <?php if (empty($stats['recentRoutines'])): ?>
        <div class="p-12 text-center">
            <span class="material-icons-round text-gray-300 dark:text-gray-600 text-5xl mb-4 block">event_note</span>
            <p class="text-gray-500 dark:text-gray-400 mb-4">A&#250;n no tienes rutinas registradas.</p>
            <a href="<?= url('/routines/generator') ?>" class="inline-flex items-center gap-2 text-primary font-medium hover:underline">
                <span class="material-icons-round text-sm">add</span>Genera tu primera rutina
            </a>
        </div>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800/50 text-xs uppercase font-medium">
                    <tr>
                        <th class="px-6 py-4">Rutina</th>
                        <th class="px-6 py-4">Fecha</th>
                        <th class="px-6 py-4">Duraci&#243;n</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4 text-right">Acci&#243;n</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                <?php foreach ($stats['recentRoutines'] as $r):
                    $fi = $focusIcons[$r['focus_area']] ?? $focusIcons['mixed'];
                    $badge = $statusBadges[$r['status']] ?? $statusBadges['generated'];
                    $label = $statusLabels[$r['status']] ?? $r['status'];
                    $date = $r['completed_at'] ?? $r['created_at'];
                    $dt = new DateTime($date);
                    $now = new DateTime('today');
                    $yday = new DateTime('yesterday');
                    if ($dt->format('Y-m-d') === $now->format('Y-m-d')) {
                        $dateStr = 'Hoy, ' . $dt->format('H:i');
                    } elseif ($dt->format('Y-m-d') === $yday->format('Y-m-d')) {
                        $dateStr = 'Ayer, ' . $dt->format('H:i');
                    } else {
                        $dateStr = $dt->format('d/m/Y H:i');
                    }
                ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <div class="flex items-center gap-3">
                                <div class="<?= $fi['bg'] ?> p-2 rounded-full <?= $fi['text'] ?>">
                                    <span class="material-icons-round text-sm"><?= $fi['icon'] ?></span>
                                </div>
                                <?= e($r['title']) ?>
                            </div>
                        </td>
                        <td class="px-6 py-4"><?= e($dateStr) ?></td>
                        <td class="px-6 py-4"><?= e($r['duration_min']) ?> min</td>
                        <td class="px-6 py-4">
                            <span class="<?= $badge ?> px-2.5 py-0.5 rounded-full text-xs font-medium"><?= e($label) ?></span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <?php if ($r['status'] === 'generated'): ?>
                            <a href="<?= url('/routines/active/' . $r['id']) ?>" class="text-primary hover:text-primary-hover" title="Continuar">
                                <span class="material-icons-round">play_circle</span>
                            </a>
                            <?php else: ?>
                            <a href="<?= url('/routines/active/' . $r['id']) ?>" class="text-gray-400 hover:text-primary" title="Ver detalles">
                                <span class="material-icons-round">info</span>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</div>
</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('activityChart');
    if (!ctx) return;

    var isDark = document.documentElement.classList.contains('dark');
    var gridColor = isDark ? '#334155' : '#e5e7eb';
    var textColor = isDark ? '#94a3b8' : '#64748b';

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($stats['chartLabels']) ?>,
            datasets: [{
                label: 'Rutinas Completadas',
                data: <?= json_encode($stats['chartData']) ?>,
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderColor: '#6366f1',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? '#1e293b' : '#ffffff',
                    titleColor: isDark ? '#f8fafc' : '#0f172a',
                    bodyColor: isDark ? '#cbd5e1' : '#475569',
                    borderColor: isDark ? '#334155' : '#e2e8f0',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(c) { return c.raw + (c.raw === 1 ? ' rutina' : ' rutinas'); }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: textColor, stepSize: 1, font: { family: "'Inter', sans-serif" } },
                    grid: { color: gridColor, drawBorder: false },
                    title: { display: true, text: 'Rutinas', color: textColor, font: { size: 11 } }
                },
                x: {
                    ticks: { color: textColor, font: { family: "'Inter', sans-serif" } },
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
});
</script>
