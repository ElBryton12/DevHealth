<?php
/**
 * DevHealth - Controlador de Soporte / Contacto
 * 
 * Maneja el formulario de contacto y guarda
 * los mensajes en la tabla contact_messages.
 */

class ContactController {

    /**
     * GET /support/contact
     * Muestra el formulario de contacto.
     */
    public function showForm(): void {
        require_once __DIR__ . '/../models/User.php';

        // La vista maneja su propio session_start y currentUser()
        require __DIR__ . '/../views/support/contact.php';
    }

    /**
     * POST /support/send
     * Procesa y guarda el mensaje de contacto.
     */
    public function send(): void {
        require_once __DIR__ . '/../models/User.php';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/support/contact');
            return;
        }

        if (!validateCsrf()) {
            setFlash('error', 'Token de seguridad inválido. Por favor, intenta de nuevo.');
            redirect('/support/contact');
            return;
        }

        // Recoger y sanear datos
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name']  ?? '');
        $email     = trim($_POST['email']      ?? '');
        $category  = trim($_POST['category']   ?? 'general');
        $message   = trim($_POST['message']    ?? '');

        // Validación básica
        $errors = [];
        if (empty($firstName)) $errors[] = 'El nombre es obligatorio.';
        if (empty($lastName))  $errors[] = 'El apellido es obligatorio.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Ingresa un correo electrónico válido.';
        }
        if (empty($message) || mb_strlen($message) < 10) {
            $errors[] = 'El mensaje debe tener al menos 10 caracteres.';
        }

        $validCategories = ['tecnico', 'sugerencia', 'general', 'bug'];
        if (!in_array($category, $validCategories)) {
            $category = 'general';
        }

        if (!empty($errors)) {
            setFlash('error', implode(' ', $errors));
            redirect('/support/contact');
            return;
        }

        // Guardar en BD
        try {
            $db = getDBConnection();
            $userId = $_SESSION['user_id'] ?? null;

            $stmt = $db->prepare(
                "INSERT INTO contact_messages 
                    (user_id, first_name, last_name, email, category, message) 
                 VALUES 
                    (:uid, :fn, :ln, :email, :cat, :msg)"
            );
            $stmt->execute([
                ':uid'   => $userId,
                ':fn'    => $firstName,
                ':ln'    => $lastName,
                ':email' => $email,
                ':cat'   => $category,
                ':msg'   => $message,
            ]);

            setFlash('success', '¡Mensaje enviado! Te responderemos pronto a ' . $email . '.');
            redirect('/support/contact');

        } catch (PDOException $e) {
            error_log('Error al guardar mensaje de contacto: ' . $e->getMessage());
            setFlash('error', 'Ocurrió un error al enviar el mensaje. Por favor, intenta más tarde.');
            redirect('/support/contact');
        }
    }
}
