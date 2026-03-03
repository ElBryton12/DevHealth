# DevHealth - Plataforma de Salud Ocupacional Digital

> PWA de bienestar para desarrolladores y estudiantes de ciencias de la computación.  
> Proyecto universitario alineado con el **ODS 3 - Salud y Bienestar**.

## 🛠 Stack Tecnológico

- **Backend:** PHP 8+ (MVC sin framework)
- **Base de datos:** MySQL / MariaDB
- **Frontend:** Tailwind CSS (CDN), JavaScript vanilla
- **Fuentes:** Inter (Google Fonts)
- **Iconos:** Material Icons + Font Awesome

## 📁 Estructura del Proyecto

```
devhealth/
├── config/
│   ├── app.php              # Constantes de la aplicación
│   ├── database.php         # Conexión PDO a MySQL
│   └── helpers.php          # Funciones auxiliares (auth, CSRF, flash, etc.)
├── controllers/
│   ├── AuthController.php   # Login, Registro, Logout
│   └── DashboardController.php
│   └── RoutineController.php
├── models/
│   └── User.php             # Modelo de usuario con autenticación
│   └── Routine.php
├── views/
│   ├── layouts/
│   │   ├── head.php         # <head> HTML reutilizable
│   │   ├── navbar.php       # Navegación (usuario autenticado)
│   │   ├── footer.php       # Pie de página
│   │   ├── flash.php        # Mensajes flash (error/success)
│   │   └── 404.php          # Página de error
│   ├── auth/
│   │   └── login.php        # Login + Registro (tabs)
│   ├── dashboard/
│   │   └── index.php        # Dashboard del usuario
│   ├── home/
│   │   └── index.php        # Landing page pública
│   ├── routines/     
│   │   └── active.php       #   
│   │   └── generator.php    # Generador de rutinas         
│   ├── education/           # (próxima fase)
│   └── support/             # (próxima fase)
├── public/
│   ├── index.php            # Front Controller (Router)
│   ├── .htaccess            # URL rewriting para Apache
│   ├── css/
│   ├── js/
│   └── images/
├── database/
│   └── 001_initial_schema.sql  # Migración SQL inicial
└── README.md
```

## ⚡ Instalación Rápida

### 1. Requisitos
- PHP 8.0+
- MySQL 5.7+ o MariaDB 10.3+
- Apache con `mod_rewrite` habilitado
- Extensión PHP `pdo_mysql`

### 2. Clonar el proyecto
```bash
git clone https://github.com/ElBryton12/DevHealth Devhealth
cd Devhealth
```

### 3. Crear la base de datos
```bash
mysql -u root -p < database/001_initial_schema.sql
```

### 4. Configurar la conexión
Editar `config/database.php` con tus credenciales:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'devhealth');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
```

### 5. Configurar URL base
Editar `config/app.php`:
```php
define('BASE_URL', '/DevHealth/public');
```

### 6. Configurar Apache
Asegurar que el `DocumentRoot` apunte a la carpeta del proyecto o crear un VirtualHost.
El `.htaccess` en `public/` ya está configurado.

### 7. Acceder
```
http://localhost/devhealth/public/
```

## 🔐 Características implementadas (Fase 1)

- [x] Estructura MVC limpia sin framework
- [x] Sistema de autenticación (registro + login + logout)
- [x] Hashing de contraseñas con bcrypt
- [x] Protección CSRF en formularios
- [x] Mensajes flash (éxito/error)
- [x] Indicador de fortaleza de contraseña
- [x] Toggle mostrar/ocultar contraseña
- [x] Dark mode automático (preferencia del sistema)
- [x] Diseño responsive
- [x] Dashboard placeholder post-login
- [x] Navbar reutilizable con rutas activas
- [x] Esquema de BD con 5 tablas relacionadas

## 📋 Próximas fases

- [ ] Generador de rutinas inteligente
- [ ] Vista de ejecución de rutina activa
- [ ] Historial de rutinas completadas
- [ ] Guía de higiene postural
- [ ] Guía de salud visual
- [ ] Formulario de contacto/soporte
- [ ] Landing page completa
- [ ] Service Worker (PWA)
- [ ] Notificaciones de pausas activas

## 👥 Autores

Proyecto universitario - Ciencias de la Computación
Brayan De Jesús Castillo
Eduardo García Mendoza

---

*Alineado con el ODS 3: Salud y Bienestar de las Naciones Unidas.*
