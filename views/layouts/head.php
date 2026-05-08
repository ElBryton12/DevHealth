<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'DevHealth') ?> - <?= APP_NAME ?></title>

    <?php
    /**
     * IMPORTANTE: Este script debe ir ANTES de Tailwind para evitar el flash
     * blanco→oscuro al cargar la página en dark mode.
     * Lee localStorage y aplica la clase 'dark' al <html> inmediatamente.
     */
    ?>
    <script>
        (function() {
            if (localStorage.getItem('devhealth_theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <!-- Fuente Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined|Material+Icons+Round" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= url('/favicon.ico') ?>">

    <!-- Estilos propios -->
    <link rel="stylesheet" href="<?= url('/css/styles.css') ?>">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "<?= THEME_PRIMARY ?>",
                        "primary-hover": "<?= THEME_PRIMARY_HOVER ?>",
                        "background-light": "#f3f4f6",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "text-light": "#1f2937",
                        "text-dark": "#f8fafc",
                        "muted-light": "#6b7280",
                        "muted-dark": "#94a3b8",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <?php if (!empty($extraHead)): ?>
        <?= $extraHead ?>
    <?php endif; ?>
</head>
