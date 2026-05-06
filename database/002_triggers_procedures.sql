-- =============================================
-- DevHealth - Migración 002
-- Triggers y Procedimientos Almacenados
-- Ejecutar después de 001_initial_schema.sql
-- =============================================

USE devhealth;

-- ============================================================
-- TRIGGERS
-- ============================================================

-- -------------------------------------------------------
-- TRIGGER 1: Crear preferencias automáticamente al registrar
--            un nuevo usuario (evita que PHP tenga que hacerlo)
-- -------------------------------------------------------
DROP TRIGGER IF EXISTS trg_after_user_insert;

DELIMITER $$
CREATE TRIGGER trg_after_user_insert
    AFTER INSERT ON users
    FOR EACH ROW
BEGIN
    INSERT INTO user_preferences (user_id, dark_mode, break_interval, notifications)
    VALUES (NEW.id, 0, 45, 1);
END$$
DELIMITER ;


-- -------------------------------------------------------
-- TRIGGER 2: Registrar en activity_log automáticamente
--            cuando una rutina cambia a estado 'completed'
-- -------------------------------------------------------
DROP TRIGGER IF EXISTS trg_after_routine_completed;

DELIMITER $$
CREATE TRIGGER trg_after_routine_completed
    AFTER UPDATE ON routines
    FOR EACH ROW
BEGIN
    -- Solo actuar cuando el status cambia a 'completed'
    IF NEW.status = 'completed' AND OLD.status != 'completed' THEN
        INSERT INTO activity_log (user_id, routine_id, activity_type, details)
        VALUES (
            NEW.user_id,
            NEW.id,
            'routine_completed',
            JSON_OBJECT(
                'routine_id',   NEW.id,
                'title',        NEW.title,
                'duration_min', NEW.duration_min,
                'focus_area',   NEW.focus_area
            )
        );
    END IF;
END$$
DELIMITER ;


-- -------------------------------------------------------
-- TRIGGER 3: Registrar en activity_log cuando se inserta
--            un mensaje de contacto (auditoría de soporte)
-- -------------------------------------------------------
DROP TRIGGER IF EXISTS trg_after_contact_insert;

DELIMITER $$
CREATE TRIGGER trg_after_contact_insert
    AFTER INSERT ON contact_messages
    FOR EACH ROW
BEGIN
    INSERT INTO activity_log (user_id, routine_id, activity_type, details)
    VALUES (
        NEW.user_id,
        NULL,
        'contact_message_sent',
        JSON_OBJECT(
            'message_id', NEW.id,
            'category',   NEW.category,
            'email',      NEW.email
        )
    );
END$$
DELIMITER ;


-- ============================================================
-- PROCEDIMIENTOS ALMACENADOS
-- ============================================================

-- -------------------------------------------------------
-- PROCEDIMIENTO 1: GetUserStats
-- Retorna todas las estadísticas del dashboard en una
-- sola llamada, calculadas directamente en MySQL.
--
-- Uso desde PHP:
--   CALL GetUserStats(:user_id)
-- -------------------------------------------------------
DROP PROCEDURE IF EXISTS GetUserStats;

DELIMITER $$
CREATE PROCEDURE GetUserStats(IN p_user_id INT)
BEGIN
    SELECT
        -- Pausas completadas esta semana
        SUM(CASE
            WHEN status = 'completed'
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)
            THEN 1 ELSE 0
        END) AS weekly_completed,

        -- Pausas completadas la semana pasada (para comparación)
        SUM(CASE
            WHEN status = 'completed'
             AND YEARWEEK(completed_at, 1) = YEARWEEK(DATE_SUB(NOW(), INTERVAL 1 WEEK), 1)
            THEN 1 ELSE 0
        END) AS last_week_completed,

        -- Descansos visuales esta semana
        SUM(CASE
            WHEN status = 'completed'
             AND focus_area = 'visual'
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)
            THEN 1 ELSE 0
        END) AS visual_breaks,

        -- Minutos activos esta semana
        COALESCE(SUM(CASE
            WHEN status = 'completed'
             AND YEARWEEK(completed_at, 1) = YEARWEEK(NOW(), 1)
            THEN duration_min ELSE 0
        END), 0) AS active_minutes,

        -- Total de rutinas completadas (histórico)
        SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS total_completed,

        -- Total de rutinas generadas
        COUNT(*) AS total_generated

    FROM routines
    WHERE user_id = p_user_id;
END$$
DELIMITER ;


-- -------------------------------------------------------
-- PROCEDIMIENTO 2: CompleteRoutine
-- Marca una rutina como completada dentro de una
-- transacción atómica, garantizando que la rutina
-- existe y pertenece al usuario antes de actualizar.
--
-- Uso desde PHP:
--   CALL CompleteRoutine(:routine_id, :user_id, @result)
--   SELECT @result  → 1=éxito, 0=no encontrada
-- -------------------------------------------------------
DROP PROCEDURE IF EXISTS CompleteRoutine;

DELIMITER $$
CREATE PROCEDURE CompleteRoutine(
    IN  p_routine_id INT,
    IN  p_user_id    INT,
    OUT p_result     TINYINT
)
BEGIN
    DECLARE v_count INT DEFAULT 0;

    -- Verificar que la rutina existe y pertenece al usuario
    SELECT COUNT(*) INTO v_count
    FROM routines
    WHERE id = p_routine_id
      AND user_id = p_user_id
      AND status != 'completed';

    IF v_count > 0 THEN
        START TRANSACTION;

        -- Actualizar rutina (el trigger trg_after_routine_completed
        -- insertará automáticamente en activity_log)
        UPDATE routines
        SET status       = 'completed',
            completed_at = NOW()
        WHERE id      = p_routine_id
          AND user_id = p_user_id;

        COMMIT;
        SET p_result = 1;
    ELSE
        SET p_result = 0;
    END IF;
END$$
DELIMITER ;


-- -------------------------------------------------------
-- PROCEDIMIENTO 3: GetUserProfile
-- Retorna el perfil completo del usuario junto con
-- sus preferencias en una sola consulta con JOIN.
--
-- Uso desde PHP:
--   CALL GetUserProfile(:user_id)
-- -------------------------------------------------------
DROP PROCEDURE IF EXISTS GetUserProfile;

DELIMITER $$
CREATE PROCEDURE GetUserProfile(IN p_user_id INT)
BEGIN
    SELECT
        u.id,
        u.first_name,
        u.last_name,
        u.email,
        u.avatar,
        u.role,
        u.is_active,
        u.created_at                AS member_since,
        p.dark_mode,
        p.break_interval,
        p.focus_areas,
        p.notifications,
        p.updated_at                AS preferences_updated
    FROM users u
    LEFT JOIN user_preferences p ON u.id = p.user_id
    WHERE u.id = p_user_id
    LIMIT 1;
END$$
DELIMITER ;


-- ============================================================
-- VERIFICACIÓN
-- Ejecuta estas consultas para confirmar que todo se creó:
-- ============================================================

-- SHOW TRIGGERS FROM devhealth;
-- SHOW PROCEDURE STATUS WHERE Db = 'devhealth';
