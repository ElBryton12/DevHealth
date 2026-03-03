<?php
/**
 * DevHealth - Modelo de Rutinas
 * 
 * Banco de ejercicios y lógica para generar rutinas personalizadas.
 */

require_once __DIR__ . '/../config/database.php';

class Routine {
    private PDO $db;

    /**
     * Banco de ejercicios organizados por zona
     */
    private const EXERCISES = [
        'neck' => [
            [
                'name'           => 'Estiramiento de Cuello Lateral',
                'description'    => 'Inclina suavemente la cabeza hacia el hombro derecho y sostén 15 segundos. Repite hacia el lado izquierdo. Mantén los hombros relajados y abajo.',
                'zone'           => 'Cuello',
                'icon'           => 'airline_seat_recline_normal',
                'color'          => 'yellow',
                'duration'       => 30,
                'duration_label' => '30 Segundos (15s cada lado)',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Rotación de Cuello',
                'description'    => 'Gira lentamente la cabeza en círculos completos, 5 repeticiones en cada dirección. Mantén el movimiento suave y controlado sin forzar.',
                'zone'           => 'Cuello',
                'icon'           => 'rotate_right',
                'color'          => 'yellow',
                'duration'       => 40,
                'duration_label' => '40 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Retracción Cervical (Doble Mentón)',
                'description'    => 'Siéntate erguido y lleva el mentón hacia atrás como creando una "doble papada". Sostén 5 segundos y repite 8 veces. Fortalece los músculos cervicales profundos.',
                'zone'           => 'Cuello',
                'icon'           => 'face',
                'color'          => 'orange',
                'duration'       => 45,
                'duration_label' => '45 Segundos',
                'intensity'      => 2,
            ],
        ],
        'back' => [
            [
                'name'           => 'Estiramiento Torácico (Brazos en W)',
                'description'    => 'Abre los brazos formando una W, llevando los codos hacia atrás y juntando los omóplatos. Abre el pecho para contrarrestar la postura encorvada frente al teclado.',
                'zone'           => 'Espalda Alta',
                'icon'           => 'accessibility',
                'color'          => 'teal',
                'duration'       => 45,
                'duration_label' => '45 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Rotación Espinal Sentado',
                'description'    => 'Sentado en tu silla, cruza el brazo derecho hacia la rodilla izquierda y gira el torso. Mantén 15 segundos y cambia de lado. Alivia la tensión lumbar.',
                'zone'           => 'Espalda Baja',
                'icon'           => 'swap_horiz',
                'color'          => 'indigo',
                'duration'       => 40,
                'duration_label' => '40 Segundos (20s cada lado)',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Cat-Cow de Pie',
                'description'    => 'De pie, con manos en las rodillas, alterna entre arquear la espalda (gato) y hundirla (vaca). Realiza 10 repeticiones lentas para movilizar toda la columna.',
                'zone'           => 'Espalda Completa',
                'icon'           => 'pets',
                'color'          => 'cyan',
                'duration'       => 50,
                'duration_label' => '50 Segundos',
                'intensity'      => 2,
            ],
            [
                'name'           => 'Extensión Lumbar de Pie',
                'description'    => 'De pie, coloca las manos en la zona lumbar y extiende suavemente el torso hacia atrás. Sostén 10 segundos y repite 5 veces.',
                'zone'           => 'Espalda Baja',
                'icon'           => 'straighten',
                'color'          => 'blue',
                'duration'       => 55,
                'duration_label' => '55 Segundos',
                'intensity'      => 2,
            ],
        ],
        'wrists' => [
            [
                'name'           => 'Extensión de Muñecas',
                'description'    => 'Extiende el brazo con la palma hacia arriba. Con la otra mano, tira suavemente de los dedos hacia abajo y hacia atrás. Esencial para prevenir el túnel carpiano.',
                'zone'           => 'Manos y Muñecas',
                'icon'           => 'pan_tool',
                'color'          => 'red',
                'duration'       => 40,
                'duration_label' => '40 Segundos (20s cada mano)',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Círculos de Muñeca',
                'description'    => 'Entrelaza los dedos y gira las muñecas en círculos suaves. 10 círculos en cada dirección. Mejora la circulación y reduce la rigidez articular.',
                'zone'           => 'Manos y Muñecas',
                'icon'           => 'autorenew',
                'color'          => 'orange',
                'duration'       => 30,
                'duration_label' => '30 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Estiramiento de Flexores',
                'description'    => 'Extiende el brazo con la palma hacia abajo. Con la otra mano, presiona los dedos hacia arriba y hacia ti. Sostén 15 segundos por mano.',
                'zone'           => 'Manos y Muñecas',
                'icon'           => 'back_hand',
                'color'          => 'rose',
                'duration'       => 35,
                'duration_label' => '35 Segundos (15s + cambio)',
                'intensity'      => 2,
            ],
        ],
        'eyes' => [
            [
                'name'           => 'Descanso Visual 20-20-20',
                'description'    => 'Mira un objeto que esté al menos a 6 metros de distancia durante 20 segundos. Esto relaja los músculos de enfoque dentro del ojo y reduce la fatiga digital.',
                'zone'           => 'Ojos',
                'icon'           => 'visibility',
                'color'          => 'green',
                'duration'       => 20,
                'duration_label' => '20 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Parpadeo Consciente',
                'description'    => 'Parpadea lentamente 20 veces seguidas. Al programar, parpadeamos hasta un 60% menos de lo normal, causando sequedad ocular y fatiga visual.',
                'zone'           => 'Ojos',
                'icon'           => 'remove_red_eye',
                'color'          => 'emerald',
                'duration'       => 25,
                'duration_label' => '25 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Enfoque Cercano-Lejano',
                'description'    => 'Sostén un dedo a 15cm de tu cara. Enfoca 5 segundos, luego enfoca un objeto lejano 5 segundos. Repite 5 veces. Ejercita los músculos ciliares del ojo.',
                'zone'           => 'Ojos',
                'icon'           => 'center_focus_strong',
                'color'          => 'green',
                'duration'       => 50,
                'duration_label' => '50 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Movimientos Oculares Dirigidos',
                'description'    => 'Sin mover la cabeza, mira arriba-abajo, izquierda-derecha, y en diagonal. 5 repeticiones por dirección. Fortalece los músculos extraoculares.',
                'zone'           => 'Ojos',
                'icon'           => 'motion_photos_on',
                'color'          => 'lime',
                'duration'       => 40,
                'duration_label' => '40 Segundos',
                'intensity'      => 2,
            ],
        ],
        'general' => [
            [
                'name'           => 'Respiración Diafragmática 4-7-8',
                'description'    => 'Inhala por la nariz contando hasta 4, sostén contando hasta 7, exhala por la boca contando hasta 8. Repite 3 veces. Reduce el estrés y la ansiedad.',
                'zone'           => 'Relajación',
                'icon'           => 'air',
                'color'          => 'sky',
                'duration'       => 60,
                'duration_label' => '60 Segundos',
                'intensity'      => 1,
            ],
            [
                'name'           => 'Elevación de Pantorrillas',
                'description'    => 'De pie, sube y baja sobre las puntas de los pies. 15 repeticiones. Activa la circulación en las piernas después de estar sentado mucho tiempo.',
                'zone'           => 'Piernas',
                'icon'           => 'directions_walk',
                'color'          => 'amber',
                'duration'       => 30,
                'duration_label' => '30 Segundos',
                'intensity'      => 2,
            ],
            [
                'name'           => 'Estiramiento de Hombros',
                'description'    => 'Sube los hombros hacia las orejas, sostén 5 segundos y suelta dejándolos caer. Repite 8 veces. Libera la tensión acumulada en los trapecios.',
                'zone'           => 'Hombros',
                'icon'           => 'expand_less',
                'color'          => 'violet',
                'duration'       => 40,
                'duration_label' => '40 Segundos',
                'intensity'      => 1,
            ],
        ],
    ];

    public function __construct() {
        $this->db = getDBConnection();
    }

    /**
     * Generar una rutina personalizada
     */
    public function generate(int $userId, int $duration, array $painAreas, int $intensity): array {
        $exerciseCount = match($duration) {
            5  => 3,
            15 => 6,
            default => 4,
        };

        $intensityLabel = match($intensity) {
            1 => 'light',
            3 => 'intense',
            default => 'moderate',
        };

        // Recolectar ejercicios candidatos
        $candidates = [];

        foreach ($painAreas as $area) {
            if (isset(self::EXERCISES[$area])) {
                foreach (self::EXERCISES[$area] as $ex) {
                    $ex['priority'] = 2;
                    $candidates[] = $ex;
                }
            }
        }

        foreach (self::EXERCISES['general'] as $ex) {
            $ex['priority'] = 1;
            $candidates[] = $ex;
        }

        if (empty($painAreas)) {
            foreach (self::EXERCISES as $zone => $exercises) {
                if ($zone === 'general') continue;
                foreach ($exercises as $ex) {
                    $ex['priority'] = 1;
                    $candidates[] = $ex;
                }
            }
        }

        if ($intensity === 1) {
            $filtered = array_filter($candidates, fn($ex) => $ex['intensity'] <= 1);
            if (count($filtered) >= $exerciseCount) {
                $candidates = array_values($filtered);
            }
        }

        usort($candidates, fn($a, $b) => $b['priority'] - $a['priority']);

        $selected = [];
        $usedNames = [];
        
        foreach ($candidates as $ex) {
            if (count($selected) >= $exerciseCount) break;
            if (!in_array($ex['name'], $usedNames)) {
                $selected[] = $ex;
                $usedNames[] = $ex['name'];
            }
        }

        $exercises = array_map(function($ex, $idx) {
            unset($ex['priority'], $ex['intensity']);
            $ex['step'] = $idx + 1;
            return $ex;
        }, $selected, array_keys($selected));

        $focusAreas = $this->getFocusLabel($painAreas);
        $title = "Pausa Activa - {$focusAreas}";

        $focusArea = 'mixed';
        if (count($painAreas) === 1) {
            $focusArea = match($painAreas[0]) {
                'eyes' => 'visual',
                default => 'postural',
            };
        }

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO routines (user_id, title, focus_area, difficulty, duration_min, exercises, status) 
                 VALUES (:uid, :title, :focus, :diff, :dur, :exercises, 'generated')"
            );
            $stmt->execute([
                ':uid'       => $userId,
                ':title'     => $title,
                ':focus'     => $focusArea,
                ':diff'      => $intensityLabel,
                ':dur'       => $duration,
                ':exercises' => json_encode($exercises, JSON_UNESCAPED_UNICODE),
            ]);

            $routineId = (int) $this->db->lastInsertId();

            return [
                'success' => true,
                'routine' => [
                    'id'          => $routineId,
                    'title'       => $title,
                    'focus_label' => $focusAreas,
                    'focus_area'  => $focusArea,
                    'difficulty'  => $intensityLabel,
                    'duration'    => $duration,
                    'exercises'   => $exercises,
                    'count'       => count($exercises),
                ],
            ];
        } catch (PDOException $e) {
            error_log("Error al generar rutina: " . $e->getMessage());
            return ['success' => false, 'error' => 'Error al guardar la rutina.'];
        }
    }

    /**
     * Obtener una rutina por ID
     */
    public function findById(int $id, int $userId): ?array {
        $stmt = $this->db->prepare("SELECT * FROM routines WHERE id = :id AND user_id = :uid LIMIT 1");
        $stmt->execute([':id' => $id, ':uid' => $userId]);
        $routine = $stmt->fetch();
        
        if ($routine) {
            $routine['exercises'] = json_decode($routine['exercises'], true);
        }
        
        return $routine ?: null;
    }

    /**
     * Marcar rutina como completada
     */
    public function markCompleted(int $id, int $userId): bool {
        $stmt = $this->db->prepare(
            "UPDATE routines SET status = 'completed', completed_at = NOW() WHERE id = :id AND user_id = :uid"
        );
        return $stmt->execute([':id' => $id, ':uid' => $userId]);
    }

    private function getFocusLabel(array $painAreas): string {
        $labels = [
            'neck'   => 'Cuello',
            'back'   => 'Espalda',
            'wrists' => 'Muñecas',
            'eyes'   => 'Fatiga Visual',
        ];
        if (empty($painAreas)) return 'General';
        $names = array_map(fn($a) => $labels[$a] ?? $a, $painAreas);
        return count($names) <= 2 ? implode(' & ', $names) : implode(', ', array_slice($names, 0, -1)) . ' & ' . end($names);
    }

    public static function intensityLabel(string $difficulty): string {
        return match($difficulty) {
            'light'  => 'Suave',
            'intense' => 'Activo',
            default   => 'Moderado',
        };
    }
}
