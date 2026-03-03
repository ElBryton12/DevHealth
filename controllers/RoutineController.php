<?php
/**
 * DevHealth - Controlador de Rutinas
 */

require_once __DIR__ . '/../models/Routine.php';
require_once __DIR__ . '/../models/User.php';

class RoutineController {
    private Routine $routineModel;

    public function __construct() {
        $this->routineModel = new Routine();
    }

    /**
     * Mostrar el generador de rutinas
     */
    public function showGenerator(): void {
        requireAuth();
        $user = currentUser();
        require __DIR__ . '/../views/routines/generator.php';
    }

    /**
     * Procesar generación de rutina
     */
    public function generate(): void {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/routines/generator');
            return;
        }

        if (!validateCsrf()) {
            setFlash('error', 'Token de seguridad inválido.');
            redirect('/routines/generator');
            return;
        }

        $userId    = $_SESSION['user_id'];
        $duration  = (int) ($_POST['duration'] ?? 10);
        $painAreas = $_POST['pain_areas'] ?? [];
        $intensity = (int) ($_POST['intensity'] ?? 2);

        // Validar
        if (!in_array($duration, [5, 10, 15])) $duration = 10;
        if ($intensity < 1 || $intensity > 3) $intensity = 2;

        $validAreas = ['neck', 'back', 'wrists', 'eyes'];
        $painAreas = array_filter($painAreas, fn($a) => in_array($a, $validAreas));

        $result = $this->routineModel->generate($userId, $duration, $painAreas, $intensity);

        if ($result['success']) {
            $this->logActivity($userId, 'routine_generated', [
                'routine_id' => $result['routine']['id'],
                'duration'   => $duration,
            ]);
            redirect('/routines/active/' . $result['routine']['id']);
        } else {
            setFlash('error', $result['error']);
            redirect('/routines/generator');
        }
    }

    /**
     * Mostrar rutina activa
     */
    public function showActive(int $routineId): void {
        requireAuth();
        $user = currentUser();
        $userId = $_SESSION['user_id'];

        $routine = $this->routineModel->findById($routineId, $userId);

        if (!$routine) {
            setFlash('error', 'Rutina no encontrada.');
            redirect('/routines/generator');
            return;
        }

        require __DIR__ . '/../views/routines/active.php';
    }

    /**
     * Marcar rutina como completada
     */
    public function complete(int $routineId): void {
        requireAuth();
        $userId = $_SESSION['user_id'];

        $this->routineModel->markCompleted($routineId, $userId);
        $this->logActivity($userId, 'routine_completed', ['routine_id' => $routineId]);

        setFlash('success', '¡Excelente! Rutina completada. ¡Sigue así!');
        redirect('/dashboard');
    }

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
            error_log("Error log actividad: " . $e->getMessage());
        }
    }
}
