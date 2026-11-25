<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Cita.php';

class HomeController
{
    public function index(): void
    {
        require __DIR__ . '/../views/home/index.php';
    }
}
