<?php

require_once __DIR__ . '/../models/Cita.php';

class CitaController
{
    public function index(): void
    {
        $citaModel = new Cita();
        $citas = $citaModel->getAll();

        require __DIR__ . '/../views/citas/index.php';
    }

    public function new(): void
    {
        $cita = [
            'id_cita' => '',
            'fecha' => date('Y-m-d'),
            'hora' => '08:00:00',
            'motivo' => '',
            'id_usuario_paciente' => '',
            'id_usuario_odontologo' => '',
            'id_usuario_administrador' => '',
            'id_estado_cita' => 1,
        ];

        $citaModel = new Cita();
        $pacientes = $citaModel->getUsuariosByRol(3);
        $odontologos = $citaModel->getUsuariosByRol(2);
        $administradores = $citaModel->getUsuariosByRol(1);
        $estados = $citaModel->getEstados();

        require __DIR__ . '/../views/citas/form.php';
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $citaModel = new Cita();
        $cita = $citaModel->findById($id);

        if (!$cita) {
            header('Location: index.php?controller=citas&action=index');
            exit;
        }

        $pacientes = $citaModel->getUsuariosByRol(3);
        $odontologos = $citaModel->getUsuariosByRol(2);
        $administradores = $citaModel->getUsuariosByRol(1);
        $estados = $citaModel->getEstados();

        require __DIR__ . '/../views/citas/form.php';
    }

    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=citas&action=index');
            exit;
        }

        $citaModel = new Cita();
        $data = [
            'fecha' => $_POST['fecha'] ?? '',
            'hora' => $_POST['hora'] ?? '',
            'motivo' => trim($_POST['motivo'] ?? ''),
            'id_usuario_paciente' => (int) ($_POST['id_usuario_paciente'] ?? 0),
            'id_usuario_odontologo' => (int) ($_POST['id_usuario_odontologo'] ?? 0),
            'id_usuario_administrador' => (int) ($_POST['id_usuario_administrador'] ?? 0),
            'id_estado_cita' => (int) ($_POST['id_estado_cita'] ?? 1),
        ];

        $id = (int) ($_POST['id_cita'] ?? 0);

        if ($id > 0) {
            $citaModel->update($id, $data);
        } else {
            $citaModel->create($data);
        }

        header('Location: index.php?controller=citas&action=index');
        exit;
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            (new Cita())->delete($id);
        }

        header('Location: index.php?controller=citas&action=index');
        exit;
    }
}
