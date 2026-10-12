<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    public function login(): void
    {
        $error = $_SESSION['error_login'] ?? null;
        unset($_SESSION['error_login']);

        require __DIR__ . '/../views/auth/login.php';
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $correo = trim($_POST['correo'] ?? '');
        $contrasenia = trim($_POST['contrasenia'] ?? '');

        $usuario = (new Usuario())->authenticate($correo, $contrasenia);

        if (!$usuario) {
            $_SESSION['error_login'] = 'Correo o contraseña incorrectos.';
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $_SESSION['usuario_id'] = (int) $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['nombre_rol'];

        header('Location: index.php?controller=home&action=index');
        exit;
    }

    public function logout(): void
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();

        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
