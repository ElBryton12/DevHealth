<?php
/**
 * DevHealth - MÉTODOS ADICIONALES para models/Routine.php
 * 
 * INSTRUCCIONES: Pega estos dos métodos DENTRO de la clase Routine,
 * justo antes del último cierre de llave (}) del archivo.
 * 
 * ─────────────────────────────────────────────
 *  PEGAR DESDE AQUÍ ↓
 * ─────────────────────────────────────────────
 */

    /**
     * Obtener el historial completo de rutinas de un usuario,
     * ordenado de la más reciente a la más antigua.
     * 
     * Usado por: views/history/history_log.php
     * 
     * @param  int   $userId
     * @return array Lista de rutinas (cada una como array asociativo)
     */
    public function getHistoryByUserId(int $userId): array {
        $stmt = $this->db->prepare(
            "SELECT id, title, focus_area, difficulty, duration_min,
                    status, completed_at, created_at
             FROM routines
             WHERE user_id = :uid
             ORDER BY created_at DESC"
        );
        $stmt->execute([':uid' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Obtener estadísticas globales del historial de un usuario.
     * 
     * Usado por: views/history/history_log.php
     * 
     * Retorna:
     *   - total            : total de rutinas (cualquier estado)
     *   - completed        : rutinas completadas
     *   - visual_completed : rutinas de tipo 'visual' completadas
     *   - total_minutes    : suma de minutos de rutinas completadas
     * 
     * @param  int   $userId
     * @return array
     */
    public function getStats(int $userId): array {
        // Total de rutinas generadas
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM routines WHERE user_id = :uid"
        );
        $stmt->execute([':uid' => $userId]);
        $total = (int) $stmt->fetchColumn();

        // Rutinas completadas
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM routines
             WHERE user_id = :uid AND status = 'completed'"
        );
        $stmt->execute([':uid' => $userId]);
        $completed = (int) $stmt->fetchColumn();

        // Descansos visuales completados
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM routines
             WHERE user_id = :uid AND status = 'completed' AND focus_area = 'visual'"
        );
        $stmt->execute([':uid' => $userId]);
        $visualCompleted = (int) $stmt->fetchColumn();

        // Minutos activos totales
        $stmt = $this->db->prepare(
            "SELECT COALESCE(SUM(duration_min), 0) FROM routines
             WHERE user_id = :uid AND status = 'completed'"
        );
        $stmt->execute([':uid' => $userId]);
        $totalMinutes = (int) $stmt->fetchColumn();

        return [
            'total'            => $total,
            'completed'        => $completed,
            'visual_completed' => $visualCompleted,
            'total_minutes'    => $totalMinutes,
        ];
    }

/**
 * ─────────────────────────────────────────────
 *  HASTA AQUÍ ↑  (no incluyas esta línea ni la de abajo)
 * ─────────────────────────────────────────────
 */
