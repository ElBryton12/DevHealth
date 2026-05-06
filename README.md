# DevHealth — Plataforma de Salud Ocupacional Digital

> Aplicación web de bienestar para desarrolladores y estudiantes de ciencias de la computación.  
> Proyecto universitario alineado con el **ODS 3 — Salud y Bienestar**.  
> Facultad de Ciencias de la Computación, BUAP · Primavera 2026

---

## 🛠 Stack Tecnológico

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2+ (MVC sin framework) |
| Base de datos | MariaDB / MySQL con PDO |
| Frontend | Tailwind CSS (CDN), JavaScript vanilla |
| Hosting | InfinityFree (LAMP) |
| Fuentes | Inter (Google Fonts) |
| Iconos | Material Icons Round + Font Awesome 6 |

**Sitio en producción:** [http://devhealth.xo.je](http://devhealth.xo.je)

---

## 📁 Estructura del Proyecto

```
Devhealth/
├── config/
│   ├── app.php                      # Constantes globales y tema
│   ├── database.php                 # Conexión PDO a MariaDB (ignorado por git)
│   ├── database.example.php         # Plantilla de configuración (sin credenciales)
│   └── helpers.php                  # Auth, CSRF, flash, url(), redirect()
├── controllers/
│   ├── AuthController.php           # Login, Registro, Logout
│   ├── DashboardController.php      # Stats reales desde la BD
│   ├── RoutineController.php        # Generador, rutina activa, completar
│   └── ContactController.php        # Formulario de soporte
├── models/
│   ├── User.php                     # Registro, login, bcrypt, preferencias
│   └── Routine.php                  # Banco de ejercicios, generación, historial
├── views/
│   ├── layouts/
│   │   ├── head.php                 # <head> con Tailwind config y dark mode
│   │   ├── navbar.php               # Nav con toggle dark/light persistente
│   │   ├── footer.php               # Footer con links de navegación
│   │   ├── flash.php                # Mensajes flash error/success
│   │   └── 404.php                  # Página de error 404
│   ├── auth/
│   │   └── login.php                # Login + Registro (tabs sin layout shift)
│   ├── home/
│   │   └── index.php                # Landing page con scroll-to-top
│   ├── dashboard/
│   │   └── index.php                # Dashboard con stats y gráfico semanal
│   ├── routines/
│   │   ├── generator.php            # Wizard de 3 pasos para generar rutina
│   │   └── active.php               # Rutina activa con temporizadores
│   ├── education/
│   │   ├── postural.php             # Guía de higiene postural
│   │   └── visual_health_guide.php  # Guía de salud visual
│   ├── history/
│   │   └── history_log.php          # Historial de rutinas del usuario
│   ├── support/
│   │   └── contact.php              # Formulario de contacto
│   └── styles/
│       └── styles.css               # Estilos globales complementarios
├── public/
│   ├── index.php                    # Front Controller (Router)
│   ├── .htaccess                    # URL rewriting para Apache
│   ├── favicon.ico                  # Favicon personalizado
│   └── css/
│       └── styles.css               # Hoja de estilos pública
├── database/
│   ├── 001_initial_schema.sql       # Esquema inicial (5 tablas)
│   └── 002_triggers_procedures.sql  # Triggers y procedimientos almacenados
├── .gitignore                           # Excluye database.php y archivos sensibles
└── README.md
```

---

## 🗄 Modelo de Base de Datos

### Tablas (5)

```
users               → Entidad principal del sistema
user_preferences    → Relación 1:1 con users (ON DELETE CASCADE)
routines            → Relación 1:N con users (ON DELETE CASCADE)
activity_log        → Auditoría de acciones del sistema
contact_messages    → Mensajes de soporte (ON DELETE SET NULL)
```

Los ejercicios se almacenan en formato **JSON** dentro de `routines.exercises` para máxima flexibilidad sin tablas adicionales.

### Triggers (3)

| Trigger | Evento | Tabla | Acción automática |
|---|---|---|---|
| `trg_after_user_insert` | AFTER INSERT | `users` | Crea preferencias por defecto en `user_preferences` |
| `trg_after_routine_completed` | AFTER UPDATE | `routines` | Registra en `activity_log` cuando status cambia a 'completed' |
| `trg_after_contact_insert` | AFTER INSERT | `contact_messages` | Registra en `activity_log` cada mensaje de soporte enviado |

### Procedimientos Almacenados (3)

| Procedimiento | Descripción |
|---|---|
| `GetUserStats(user_id)` | Calcula todas las métricas del dashboard en una sola consulta |
| `CompleteRoutine(routine_id, user_id, OUT result)` | Marca rutina completada en transacción atómica con verificación |
| `GetUserProfile(user_id)` | Retorna perfil completo del usuario con JOIN a preferencias |

---

## ⚡ Instalación Local

### Requisitos
- PHP 8.0+ con extensión `pdo_mysql`
- MariaDB / MySQL
- Apache con `mod_rewrite` habilitado

### 1. Clonar el proyecto
```bash
git clone https://github.com/ElBryton12/DevHealth Devhealth
cd Devhealth
```

### 2. Crear la base de datos e importar migraciones
```bash
# Esquema inicial
mysql -u root -p < database/001_initial_schema.sql

# Triggers y procedimientos almacenados
mysql -u root -p devhealth < database/002_triggers_procedures.sql
```

### 3. Configurar la conexión
`config/database.php` está en `.gitignore` — nunca se sube al repositorio.  
Crea tu archivo local a partir de la plantilla:
```bash
cp config/database.example.php config/database.php
```

Edita `config/database.php` con tus credenciales:
```php
define('DB_HOST', 'localhost');  // usar '127.0.0.1' en Arch Linux
define('DB_NAME', 'devhealth');
define('DB_USER', 'root');
define('DB_PASS', '');           // vacío en XAMPP por defecto
define('DB_CHARSET', 'utf8mb4');
```

### 4. Configurar URL base
Editar `config/app.php`:
```php
// XAMPP (Windows)
define('BASE_URL', '/DevHealth/public');

// Apache con DocumentRoot apuntando directamente a /public
define('BASE_URL', '');
```

### 5. Configurar Apache en Arch Linux
En `/etc/httpd/conf/httpd.conf`:
```apache
DocumentRoot "/home/tu_usuario/proyectos/Devhealth/public"
<Directory "/home/tu_usuario/proyectos/Devhealth/public">
    AllowOverride All
    Require all granted
</Directory>
```

Deshabilitar `ProtectHome` en `/etc/systemd/system/httpd.service.d/hardening.conf`:
```ini
[Service]
ProtectHome=off
```

### 6. Configurar sesiones PHP (Arch Linux)
En `/etc/php/php.ini`:
```ini
session.save_path = "/var/lib/php/sessions"
```
```bash
sudo mkdir -p /var/lib/php/sessions
sudo chown http:http /var/lib/php/sessions
```

### 7. Verificar triggers y procedimientos
```bash
mariadb -u root devhealth -e "SHOW TRIGGERS FROM devhealth; SHOW PROCEDURE STATUS WHERE Db = 'devhealth';"
```

### 8. Acceder
```
http://localhost
```

---

## ✅ Funcionalidades Implementadas

### Autenticación
- [x] Registro con validación y bcrypt
- [x] Login con sesiones PHP nativas
- [x] Logout con destrucción de sesión
- [x] Protección CSRF en todos los formularios
- [x] Indicador de fortaleza de contraseña
- [x] Toggle mostrar/ocultar contraseña
- [x] Tabs Login/Registro sin layout shift
- [x] Botón "Volver al inicio" desde el login

### Dashboard
- [x] Stats en tiempo real desde BD vía `GetUserStats` (procedimiento almacenado)
- [x] Gráfico de barras de actividad semanal con Chart.js
- [x] Tabla de actividad reciente con fechas relativas
- [x] Comparación de rendimiento vs semana anterior

### Generador de Rutinas
- [x] Wizard de 3 pasos: duración, zonas de molestia, intensidad
- [x] Banco de 17 ejercicios organizados por zona (cuello, espalda, muñecas, ojos)
- [x] Generación inteligente personalizada
- [x] Temporizadores individuales por ejercicio con barra de progreso
- [x] Marcado de rutina completada vía `CompleteRoutine` (procedimiento almacenado)
- [x] Auditoría automática en `activity_log` vía trigger

### Educación
- [x] Guía de Higiene Postural con enlace al generador
- [x] Guía de Salud Visual (regla 20-20-20, yoga ocular, configuración de pantalla)

### Historial
- [x] Listado completo de rutinas ordenado por fecha
- [x] Stats globales vía `getStats()` con procedimiento almacenado

### Soporte
- [x] Formulario de contacto con validación backend
- [x] Guardado en `contact_messages` con auditoría automática vía trigger

### UX / UI
- [x] Dark mode con persistencia en `localStorage` (sin flash al recargar)
- [x] Light mode por defecto en todos los módulos
- [x] Diseño responsive (móvil, tablet, desktop)
- [x] Favicon personalizado
- [x] Botón scroll-to-top flotante en landing page

---

## 🔒 Seguridad

- PDO con sentencias preparadas (prevención de SQL Injection)
- Tokens CSRF en todos los formularios POST
- Hashing bcrypt para contraseñas
- `session_regenerate_id()` tras login exitoso
- Rutas protegidas con `requireAuth()`
- `ON DELETE CASCADE` / `ON DELETE SET NULL` para integridad referencial

---

## 🗺 Rutas del Sistema

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/` | Landing page |
| GET | `/auth/login` | Formulario login/registro |
| POST | `/auth/login` | Procesar login |
| POST | `/auth/register` | Procesar registro |
| GET | `/auth/logout` | Cerrar sesión |
| GET | `/dashboard` | Dashboard (requiere auth) |
| GET | `/routines/generator` | Generador de rutinas |
| POST | `/routines/generate` | Crear rutina |
| GET | `/routines/active/{id}` | Ver rutina activa |
| GET | `/routines/complete/{id}` | Marcar como completada |
| GET | `/routines/history` | Historial de rutinas |
| GET | `/education/postural` | Guía postural |
| GET | `/education/visual` | Guía visual |
| GET | `/support/contact` | Formulario de contacto |
| POST | `/support/send` | Enviar mensaje |

---

## 👥 Autores

**Brayan De Jesús Castillo**  
**Eduardo García Mendoza**

Materia: Aplicaciones Web · NRC 47364  
Profesor: María del Carmen Santiago Díaz  
Facultad de Ciencias de la Computación, BUAP · Primavera 2026

---

*Alineado con el ODS 3: Salud y Bienestar — Agenda 2030 de las Naciones Unidas.*
