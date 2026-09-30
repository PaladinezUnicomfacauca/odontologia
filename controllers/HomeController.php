<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Cita.php';

class HomeController
{
    public function index(): void
    {
        $usuarioModel = new Usuario();
        $citaModel = new Cita();

        $data = [
            'totalUsuarios' => $usuarioModel->count(),
            'totalOdontologos' => $usuarioModel->countByRole(2),
            'totalPacientes' => $usuarioModel->countByRole(3),
            'totalCitas' => $citaModel->count(),
            'estadoCitas' => $citaModel->getTotalByState(),
            'ultimasCitas' => $citaModel->getLatest(5),
        ];

        require __DIR__ . '/../views/home/index.php';
    }
}
