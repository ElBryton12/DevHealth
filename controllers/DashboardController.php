<?php
/**
 * DevHealth - Controlador del Dashboard
 * Consulta estadísticas reales de la BD.
 */

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Routine.php';

class DashboardController {
    
    public function index(): void {
        requireAuth();
        
        $user = currentUser();
        $userId = $_SESSION['user_id'];
        $db = getDBConnection();

        // 1. Pausas activas completadas esta semana
        $stmt = $db->prepare(
            "SELECT COUNT(*) as total FROM routines 
             WHERE user_id = :uid AND status = 'completed' 
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)"
        );
        $stmt->execute([':uid' => $userId]);
        $weeklyCompleted = (int) $stmt->fetch()['total'];

        // Comparación con semana pasada
        $stmt = $db->prepare(
            "SELECT COUNT(*) as total FROM routines 
             WHERE user_id = :uid AND status = 'completed' 
             AND YEARWEEK(completed_at, 1) = YEARWEEK(DATE_SUB(NOW(), INTERVAL 1 WEEK), 1)"
        );
        $stmt->execute([':uid' => $userId]);
        $lastWeekCompleted = (int) $stmt->fetch()['total'];
        $weeklyDiff = $weeklyCompleted - $lastWeekCompleted;

        // 2. Racha diaria
        $stmt = $db->prepare(
            "SELECT DATE(completed_at) as day FROM routines 
             WHERE user_id = :uid AND status = 'completed' 
             GROUP BY DATE(completed_at) ORDER BY day DESC"
        );
        $stmt->execute([':uid' => $userId]);
        $days = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $streak = 0;
        $checkDate = new DateTime('today');
        foreach ($days as $day) {
            if ($day === $checkDate->format('Y-m-d')) {
                $streak++;
                $checkDate->modify('-1 day');
            } else {
                break;
            }
        }

        // 3. Descansos visuales esta semana
        $stmt = $db->prepare(
            "SELECT COUNT(*) as total FROM routines 
             WHERE user_id = :uid AND status = 'completed' AND focus_area = 'visual'
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)"
        );
        $stmt->execute([':uid' => $userId]);
        $visualBreaks = (int) $stmt->fetch()['total'];

        // 4. Tiempo activo esta semana
        $stmt = $db->prepare(
            "SELECT COALESCE(SUM(duration_min), 0) as total FROM routines 
             WHERE user_id = :uid AND status = 'completed' 
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)"
        );
        $stmt->execute([':uid' => $userId]);
        $activeMinutes = (int) $stmt->fetch()['total'];

        // 5. Gráfico: rutinas por día (últimos 7 días)
        $chartLabels = [];
        $chartData = [];
        $dayNames = ['Dom', 'Lun', 'Mar', 'Mi\u00e9', 'Jue', 'Vie', 'S\u00e1b'];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = new DateTime("-{$i} days");
            $chartLabels[] = $dayNames[(int)$date->format('w')];
            
            $stmt = $db->prepare(
                "SELECT COUNT(*) as total FROM routines 
                 WHERE user_id = :uid AND status = 'completed' AND DATE(completed_at) = :day"
            );
            $stmt->execute([':uid' => $userId, ':day' => $date->format('Y-m-d')]);
            $chartData[] = (int) $stmt->fetch()['total'];
        }

        // 6. Últimas 5 rutinas
        $stmt = $db->prepare(
            "SELECT id, title, focus_area, difficulty, duration_min, status, completed_at, created_at 
             FROM routines WHERE user_id = :uid ORDER BY created_at DESC LIMIT 5"
        );
        $stmt->execute([':uid' => $userId]);
        $recentRoutines = $stmt->fetchAll();

        // 7. Total completadas
        $stmt = $db->prepare(
            "SELECT COUNT(*) as total FROM routines WHERE user_id = :uid AND status = 'completed'"
        );
        $stmt->execute([':uid' => $userId]);
        $totalCompleted = (int) $stmt->fetch()['total'];

        $stats = compact(
            'weeklyCompleted', 'weeklyDiff', 'lastWeekCompleted',
            'streak', 'visualBreaks', 'activeMinutes',
            'chartLabels', 'chartData', 'recentRoutines', 'totalCompleted'
        );
        
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
