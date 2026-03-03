<?php
/**
 * DevHealth - Modelo de Usuario
 */

require_once __DIR__ . '/../config/database.php';

class User {
    private PDO $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    /**
     * Registrar un nuevo usuario
     */
    public function register(string $firstName, string $lastName, string $email, string $password): array {
        // Verificar si el email ya existe
        if ($this->findByEmail($email)) {
            return ['success' => false, 'error' => 'Este correo electrónico ya está registrado.'];
        }

        // Validaciones
        if (strlen($password) < 8) {
            return ['success' => false, 'error' => 'La contraseña debe tener al menos 8 caracteres.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'El correo electrónico no es válido.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO users (first_name, last_name, email, password) VALUES (:fn, :ln, :email, :pass)"
            );
            $stmt->execute([
                ':fn'    => trim($firstName),
                ':ln'    => trim($lastName),
                ':email' => strtolower(trim($email)),
                ':pass'  => $hashedPassword,
            ]);

            $userId = (int) $this->db->lastInsertId();

            // Crear preferencias por defecto
            $this->createDefaultPreferences($userId);

            return ['success' => true, 'user_id' => $userId];
        } catch (PDOException $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            return ['success' => false, 'error' => 'Error interno. Intenta de nuevo más tarde.'];
        }
    }

    /**
     * Autenticar usuario (login)
     */
    public function login(string $email, string $password): array {
        $user = $this->findByEmail($email);

        if (!$user) {
            return ['success' => false, 'error' => 'Credenciales incorrectas.'];
        }

        if (!$user['is_active']) {
            return ['success' => false, 'error' => 'Esta cuenta está desactivada.'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'Credenciales incorrectas.'];
        }

        // No devolver el hash de la contraseña
        unset($user['password']);

        return ['success' => true, 'user' => $user];
    }

    /**
     * Buscar usuario por email
     */
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => strtolower(trim($email))]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Buscar usuario por ID
     */
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT id, first_name, last_name, email, avatar, role, is_active, created_at FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Obtener iniciales del usuario para avatar
     */
    public static function getInitials(array $user): string {
        return strtoupper(
            mb_substr($user['first_name'], 0, 1) . mb_substr($user['last_name'], 0, 1)
        );
    }

    /**
     * Crear preferencias por defecto al registrar
     */
    private function createDefaultPreferences(int $userId): void {
        $stmt = $this->db->prepare(
            "INSERT INTO user_preferences (user_id, dark_mode, break_interval, notifications) VALUES (:uid, 0, 45, 1)"
        );
        $stmt->execute([':uid' => $userId]);
    }
}
