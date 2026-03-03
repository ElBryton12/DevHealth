-- =============================================
-- DevHealth - Migración Inicial
-- Base de datos: devhealth
-- =============================================

CREATE DATABASE IF NOT EXISTS devhealth
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE devhealth;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(100) NOT NULL,
    last_name   VARCHAR(100) NOT NULL,
    email       VARCHAR(255) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,  -- hash bcrypt
    avatar      VARCHAR(500) DEFAULT NULL,
    role        ENUM('user', 'admin') DEFAULT 'user',
    is_active   TINYINT(1) DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_email (email)
) ENGINE=InnoDB;

-- Tabla de rutinas generadas
CREATE TABLE IF NOT EXISTS routines (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    title           VARCHAR(255) NOT NULL,
    focus_area      VARCHAR(100) NOT NULL,  -- 'visual', 'postural', 'mixed'
    difficulty      ENUM('light', 'moderate', 'intense') DEFAULT 'moderate',
    duration_min    INT DEFAULT 10,
    exercises       JSON NOT NULL,          -- Array de ejercicios en JSON
    status          ENUM('generated', 'in_progress', 'completed', 'skipped') DEFAULT 'generated',
    completed_at    TIMESTAMP NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_routines (user_id, created_at)
) ENGINE=InnoDB;

-- Tabla de historial de actividad
CREATE TABLE IF NOT EXISTS activity_log (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    routine_id      INT DEFAULT NULL,
    activity_type   VARCHAR(50) NOT NULL,   -- 'routine_completed', 'break_taken', 'login', etc.
    details         JSON DEFAULT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (routine_id) REFERENCES routines(id) ON DELETE SET NULL,
    INDEX idx_user_activity (user_id, created_at)
) ENGINE=InnoDB;

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS contact_messages (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT DEFAULT NULL,
    first_name  VARCHAR(100) NOT NULL,
    last_name   VARCHAR(100) NOT NULL,
    email       VARCHAR(255) NOT NULL,
    category    VARCHAR(100) NOT NULL,
    message     TEXT NOT NULL,
    is_read     TINYINT(1) DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabla de preferencias del usuario
CREATE TABLE IF NOT EXISTS user_preferences (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL UNIQUE,
    dark_mode       TINYINT(1) DEFAULT 0,
    break_interval  INT DEFAULT 45,         -- minutos entre pausas
    focus_areas     JSON DEFAULT NULL,       -- áreas de enfoque preferidas
    notifications   TINYINT(1) DEFAULT 1,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
