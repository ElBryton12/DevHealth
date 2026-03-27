<?php
/**
 * DevHealth - Controlador de Autenticación
 */

require_once __DIR__ . '/../models/User.php';

class AuthController {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Mostrar página de login/registro
     */
    public function showLoginForm(): void {
        redirectIfAuthenticated();
        
        $tab = $_GET['tab'] ?? 'login';
        
        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Procesar login
     */
    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/auth/login');
            return;
        }

        if (!validateCsrf()) {
            setFlash('error', 'Token de seguridad inválido. Intenta de nuevo.');
            redirect('/auth/login');
            return;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            setFlash('error', 'Todos los campos son obligatorios.');
            redirect('/auth/login');
            return;
        }

        $result = $this->userModel->login($email, $password);

        if ($result['success']) {
            $_SESSION['user_id'] = $result['user']['id'];
            $_SESSION['user']    = $result['user'];
            session_regenerate_id(true);
            $this->logActivity($result['user']['id'], 'login');
            redirect('/dashboard');
        } else {
            setFlash('error', $result['error']);
            redirect('/auth/login');
        }
    }

    /**
     * Procesar registro
     */
    public function register(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/auth/login?tab=register');
            return;
        }

        if (!validateCsrf()) {
            setFlash('error', 'Token de seguridad inválido. Intenta de nuevo.');
            redirect('/auth/login?tab=register');
            return;
        }

        $firstName = $_POST['first_name'] ?? '';
        $lastName  = $_POST['last_name'] ?? '';
        $email     = $_POST['email'] ?? '';
        $password  = $_POST['password'] ?? '';
        $terms     = isset($_POST['terms']);

        // Validaciones
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            setFlash('error', 'Todos los campos son obligatorios.');
            redirect('/auth/login?tab=register');
            return;
        }

        if (!$terms) {
            setFlash('error', 'Debes aceptar los términos y condiciones.');
            redirect('/auth/login?tab=register');
            return;
        }

        $result = $this->userModel->register($firstName, $lastName, $email, $password);

        if ($result['success']) {
            setFlash('success', '¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.');
            redirect('/auth/login');
        } else {
            setFlash('error', $result['error']);
            redirect('/auth/login?tab=register');
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout(): void {
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        // Iniciar nueva sesión para flash message
        session_start();
        setFlash('success', 'Has cerrado sesión correctamente.');
        redirect('/auth/login');
    }

    /**
     * Registrar actividad del usuario
     */
    private function logActivity(int $userId, string $type, ?array $details = null): void {
        try {
            $db = getDBConnection();
            $stmt = $db->prepare(
                "INSERT INTO activity_log (user_id, activity_type, details) VALUES (:uid, :type, :details)"
            );
            $stmt->execute([
                ':uid'     => $userId,
                ':type'    => $type,
                ':details' => $details ? json_encode($details) : null,
            ]);
        } catch (PDOException $e) {
            error_log("Error al registrar actividad: " . $e->getMessage());
        }
    }
}
