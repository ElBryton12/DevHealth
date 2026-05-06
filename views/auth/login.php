<?php
/**
 * DevHealth - Vista de Login y Registro
 * Convertida desde la maqueta de Google Stitch a PHP funcional.
 */
$pageTitle = 'Iniciar Sesión';
$tab = $tab ?? ($_GET['tab'] ?? 'login');
?>
<?php require __DIR__ . '/../layouts/head.php'; ?>

<style>
    .tab-content {
        transition: opacity 0.2s ease-in-out;
        width: 100%;
        max-width: 28rem; /* max-w-md */
    }
    .hidden-tab {
        position: absolute;
        top: 0; left: 0;
        visibility: hidden;
        opacity: 0;
        pointer-events: none;
    }
    .visible-tab {
        position: relative;
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
    }
</style>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans antialiased transition-colors duration-300 min-h-screen flex items-center justify-center p-4">

<button class="fixed top-4 right-4 z-50 p-2 rounded-full bg-surface-light dark:bg-surface-dark shadow-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors border border-gray-200 dark:border-slate-700"
        onclick="document.documentElement.classList.toggle('dark')">
    <i class="fas fa-moon text-indigo-600 dark:hidden"></i>
    <i class="fas fa-sun text-yellow-400 hidden dark:block"></i>
</button>

<main class="w-full max-w-[1200px] h-full md:min-h-[750px] bg-surface-light dark:bg-surface-dark rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-200 dark:border-slate-700">
    <div class="hidden md:flex w-full md:w-1/2 bg-indigo-50 dark:bg-slate-900 relative items-center justify-center overflow-hidden">
        <img alt="Espacio de trabajo saludable" 
             class="absolute inset-0 w-full h-full object-cover opacity-80 dark:opacity-40"
             src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?w=800&q=80">
        <div class="absolute inset-0 bg-gradient-to-tr from-primary/80 to-purple-600/60 mix-blend-multiply"></div>
        
        <div class="relative z-10 p-12 text-white flex flex-col justify-between h-full">
            <div class="mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                        <i class="fas fa-heart-pulse text-2xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-wide"><?= APP_NAME ?></span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    Codifica Mejor,<br> Vive Más Sano.
                </h1>
                <p class="text-lg text-indigo-100 max-w-md">
                    Tu plataforma personalizada para prevenir la fatiga física y mantener la salud visual mientras construyes el futuro.
                </p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl border border-white/20">
                <div class="flex gap-1 text-yellow-300 mb-2">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-sm italic mb-3">"Esta plataforma cambió mi rutina. Mi dolor de espalda desapareció y me siento más enfocado durante las sesiones de código."</p>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-xs font-bold">AC</div>
                    <div>
                        <p class="text-xs font-bold">Alex Chen</p>
                        <p class="text-xs text-indigo-200">Senior Frontend Dev</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 pt-14 flex flex-col justify-center relative bg-surface-light dark:bg-surface-dark md:h-[750px]">
        
        <!-- Botón volver al inicio — esquina superior izquierda -->
        <a href="<?= url('/') ?>"
           class="absolute top-4 left-6 flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors group">
            <span class="material-icons-round text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
            <span>Volver al inicio</span>
        </a>

        <!-- Logo móvil -->
        <div class="md:hidden flex items-center justify-center gap-2 mb-8 text-primary">
            <i class="fas fa-heart-pulse text-2xl"></i>
            <span class="text-xl font-bold text-text-light dark:text-text-dark"><?= APP_NAME ?></span>
        </div>

        <!-- Tabs -->
        <div class="flex p-1 bg-background-light dark:bg-slate-700 rounded-lg mb-8 w-fit mx-auto md:mx-0">
            <button class="px-6 py-2 rounded-md text-sm font-medium transition-all <?= $tab === 'login' ? 'shadow-sm bg-white dark:bg-slate-600 text-primary dark:text-white' : 'text-muted-light dark:text-muted-dark' ?>"
                    id="tab-login" onclick="switchTab('login')">Iniciar Sesión</button>
            <button class="px-6 py-2 rounded-md text-sm font-medium transition-all <?= $tab === 'register' ? 'shadow-sm bg-white dark:bg-slate-600 text-primary dark:text-white' : 'text-muted-light dark:text-muted-dark' ?>"
                    id="tab-register" onclick="switchTab('register')">Registrarse</button>
        </div>

        <!-- ===== LOGIN ===== -->
        <div class="relative w-full" style="min-height: 440px;">
        <div class="<?= $tab === 'login' ? 'visible-tab' : 'hidden-tab' ?> tab-content max-w-md w-full mx-auto md:mx-0" id="login-form">
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">Bienvenido de vuelta</h2>
                <p class="text-muted-light dark:text-muted-dark">Ingresa tus datos para acceder.</p>
            </div>

            <?php if ($tab === 'login') require __DIR__ . '/../layouts/flash.php'; ?>

            <form class="space-y-5" action="<?= url('/auth/login') ?>" method="POST">
                <?= csrfField() ?>
                
                <div>
                    <label class="block text-sm font-medium mb-2" for="login-email">Correo Electrónico</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3.5 text-muted-light dark:text-slate-500"></i>
                        <input class="w-full pl-10 pr-4 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary transition-colors"
                               id="login-email" name="email" type="email" placeholder="dev@ejemplo.com" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2" for="login-password">Contraseña</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-muted-light dark:text-slate-500"></i>
                        <input class="w-full pl-10 pr-12 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary transition-colors"
                               id="login-password" name="password" type="password" placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword('login-password', this)" class="absolute right-3 top-3.5 text-muted-light hover:text-text-light dark:hover:text-white">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="flex justify-end mt-1">
                        <a class="text-xs font-medium text-primary hover:text-primary-hover" href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-primary-hover text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Iniciar Sesión
                </button>
            </form>
        </div>

        <!-- ===== REGISTRO ===== -->
        <div class="<?= $tab === 'register' ? 'visible-tab' : 'hidden-tab' ?> tab-content max-w-md w-full mx-auto md:mx-0" id="register-form">
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">Crear Cuenta</h2>
                <p class="text-muted-light dark:text-muted-dark">Únete a nuestra comunidad de desarrolladores saludables.</p>
            </div>

            <?php if ($tab === 'register') require __DIR__ . '/../layouts/flash.php'; ?>

            <form class="space-y-4" action="<?= url('/auth/register') ?>" method="POST">
                <?= csrfField() ?>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1" for="reg-fname">Nombre</label>
                        <input class="w-full px-4 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary"
                               id="reg-fname" name="first_name" type="text" placeholder="Juan" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1" for="reg-lname">Apellido</label>
                        <input class="w-full px-4 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary"
                               id="reg-lname" name="last_name" type="text" placeholder="Pérez" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2" for="reg-email">Correo Electrónico</label>
                    <input class="w-full px-4 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary"
                           id="reg-email" name="email" type="email" placeholder="dev@ejemplo.com" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2" for="reg-password">Crear Contraseña</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 rounded-lg bg-background-light dark:bg-slate-800 border-gray-200 dark:border-slate-600 focus:border-primary focus:ring-primary"
                               id="reg-password" name="password" type="password" placeholder="••••••••" required minlength="8">
                        <button type="button" onclick="togglePassword('reg-password', this)" class="absolute right-3 top-3.5 text-muted-light hover:text-text-light dark:hover:text-white">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="flex gap-1">
                            <div id="str-1" class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-slate-700 transition-colors"></div>
                            <div id="str-2" class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-slate-700 transition-colors"></div>
                            <div id="str-3" class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-slate-700 transition-colors"></div>
                            <div id="str-4" class="h-1 flex-1 rounded-full bg-gray-200 dark:bg-slate-700 transition-colors"></div>
                        </div>
                        <p id="str-text" class="text-xs text-muted-light dark:text-muted-dark mt-1">Mínimo 8 caracteres.</p>
                    </div>
                </div>

                <div class="flex items-start gap-2 pt-2">
                    <input class="mt-1 rounded border-gray-300 text-primary focus:ring-primary" id="reg-terms" name="terms" type="checkbox" value="1" required>
                    <label class="text-xs text-muted-light dark:text-muted-dark" for="reg-terms">
                        Acepto los <a class="text-primary hover:underline" href="#">Términos de Servicio</a> y la <a class="text-primary hover:underline" href="#">Política de Privacidad</a>.
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-primary-hover text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 mt-2">
                    Crear Cuenta
                </button>
            </form>
        </div>

        </div><!-- /tabs-wrapper -->

        <div class="mt-8 text-center md:text-left">
            <p class="text-xs text-muted-light dark:text-muted-dark">
                ¿Tienes problemas? <a class="text-primary hover:underline" href="<?= url('/support/contact') ?>">Contactar Soporte</a>
            </p>
        </div>
    </div>
</main>

<script>
function switchTab(tab) {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginBtn = document.getElementById('tab-login');
    const registerBtn = document.getElementById('tab-register');
    const activeClasses = ['shadow-sm', 'bg-white', 'dark:bg-slate-600', 'text-primary', 'dark:text-white'];
    const inactiveClasses = ['text-muted-light', 'dark:text-muted-dark'];

    if (tab === 'login') {
        loginForm.classList.remove('hidden-tab');
        loginForm.classList.add('visible-tab');
        registerForm.classList.remove('visible-tab');
        registerForm.classList.add('hidden-tab');
        activeClasses.forEach(c => { loginBtn.classList.add(c); registerBtn.classList.remove(c); });
        inactiveClasses.forEach(c => { loginBtn.classList.remove(c); registerBtn.classList.add(c); });
    } else {
        registerForm.classList.remove('hidden-tab');
        registerForm.classList.add('visible-tab');
        loginForm.classList.remove('visible-tab');
        loginForm.classList.add('hidden-tab');
        activeClasses.forEach(c => { registerBtn.classList.add(c); loginBtn.classList.remove(c); });
        inactiveClasses.forEach(c => { registerBtn.classList.remove(c); loginBtn.classList.add(c); });
    }
    const u = new URL(window.location);
    u.searchParams.set('tab', tab);
    window.history.replaceState({}, '', u);
}

function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

document.getElementById('reg-password')?.addEventListener('input', function(e) {
    const val = e.target.value;
    let s = 0;
    if (val.length >= 8) s++;
    if (/[a-z]/.test(val) && /[A-Z]/.test(val)) s++;
    if (/[0-9]/.test(val)) s++;
    if (/[^a-zA-Z0-9]/.test(val)) s++;

    const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
    const labels = ['Débil', 'Regular', 'Buena', 'Fuerte'];
    const def = 'bg-gray-200 dark:bg-slate-700';

    for (let i = 1; i <= 4; i++) {
        document.getElementById('str-' + i).className = 'h-1 flex-1 rounded-full transition-colors ' + (i <= s ? colors[s - 1] : def);
    }
    document.getElementById('str-text').textContent = s > 0 ? 'Fortaleza: ' + labels[s - 1] : 'Mínimo 8 caracteres.';
});

</script>
</body>
</html>
