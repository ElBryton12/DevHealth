<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Routine.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();
if (!$user) { redirect('/auth/login'); }

$routineModel = new Routine();
$history = $routineModel->getHistoryByUserId($user['id']);
$stats = $routineModel->getStats($user['id']);

include_once __DIR__ . '/../layouts/head.php';
?>

<body class="bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark font-body min-h-screen transition-colors duration-300">

<?php include_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">Historial de Rutinas</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Registro de todas tus sesiones de salud ocupacional.</p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="<?= url('/routines/generator') ?>" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md shadow-sm hover:bg-secondary transition-all text-sm font-medium">
                <span class="material-icons-round mr-2 text-lg">add</span> Nueva Rutina
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center shadow-sm">
            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                <span class="material-icons-round">fitness_center</span>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Rutinas</p>
                <p class="text-2xl font-bold dark:text-white"><?= $stats['total'] ?></p>
            </div>
        </div>
        <div class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center shadow-sm">
            <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400">
                <span class="material-icons-round">visibility</span>
            </div>
            <div class="ml-5">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Descansos Visuales</p>
                <p class="text-2xl font-bold dark:text-white"><?= $stats['visual_completed'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <?php if (empty($history)): ?>
            <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl border border-dashed border-gray-300 dark:border-gray-600">
                <span class="material-icons-round text-5xl text-gray-300 mb-4">history</span>
                <p class="text-gray-500 dark:text-gray-400">Aún no tienes rutinas registradas.</p>
            </div>
        <?php else: ?>
            <?php foreach ($history as $item): ?>
                <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all overflow-hidden">
                    <div class="p-6 sm:flex sm:items-center sm:justify-between">
                        <div class="sm:flex sm:items-start space-x-4">
                            <div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-icons-round text-2xl">
                                    <?= ($item['focus_area'] === 'visual') ? 'visibility' : 'accessibility_new' ?>
                                </span>
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white"><?= e($item['title']) ?></h3>
                                    <?php 
                                        $statusClass = $item['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800';
                                        $statusText = $item['status'] === 'completed' ? 'Completado' : 'Pendiente';
                                    ?>
                                    <span class="ml-3 px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </div>
                                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400 flex items-center gap-4">
                                    <span class="flex items-center gap-1">
                                        <span class="material-icons-round text-base">calendar_today</span>
                                        <?= date('d M, Y', strtotime($item['created_at'])) ?>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-icons-round text-base">schedule</span>
                                        <?= $item['duration_min'] ?> min
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 flex gap-3">
                            <?php if ($item['status'] === 'completed'): ?>
                                <button class="p-2 text-gray-400 hover:text-primary transition-colors">
                                    <span class="material-icons-round">download</span>
                                </button>
                            <?php endif; ?>
                            <button class="px-4 py-2 bg-primary/10 text-primary rounded-md text-sm font-medium hover:bg-primary/20 transition-colors">
                                Repetir
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>

</body>
</html>