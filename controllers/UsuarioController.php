<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{
    public function index(): void
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getAll();

        require __DIR__ . '/../views/usuarios/index.php';
    }

    public function new(): void
    {
        $usuario = [
            'id_usuario' => '',
            'nombre' => '',
            'numero_documento' => '',
            'telefono' => '',
            'correo' => '',
            'contrasenia' => '',
            'activo' => 1,
            'id_rol' => 3,
        ];

        $roles = (new Usuario())->getRoles();
        require __DIR__ . '/../views/usuarios/form.php';
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->findById($id);

        if (!$usuario) {
            header('Location: index.php?controller=usuarios&action=index');
            exit;
        }

        $roles = $usuarioModel->getRoles();
        require __DIR__ . '/../views/usuarios/form.php';
    }

    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=usuarios&action=index');
            exit;
        }

        $usuarioModel = new Usuario();
        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'numero_documento' => trim($_POST['numero_documento'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'contrasenia' => trim($_POST['contrasenia'] ?? ''),
            'activo' => isset($_POST['activo']) ? 1 : 0,
            'id_rol' => (int) ($_POST['id_rol'] ?? 3),
        ];

        $id = (int) ($_POST['id_usuario'] ?? 0);

        if ($id > 0) {
            $usuarioModel->update($id, $data);
        } else {
            $usuarioModel->create($data);
        }

        header('Location: index.php?controller=usuarios&action=index');
        exit;
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            (new Usuario())->delete($id);
        }

        header('Location: index.php?controller=usuarios&action=index');
        exit;
    }
}
