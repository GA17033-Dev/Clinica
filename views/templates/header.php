<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Citas Médicas</title>
    <?php require_once 'views/templates/resources.php'; ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="bi bi-hospital me-2"></i>
                <span>Clínica Médica</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=paciente&action=index">
                            <i class="bi bi-people me-1"></i> Pacientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=medico&action=index">
                            <i class="bi bi-file-person me-1"></i> Médicos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=especialidad&action=index">
                            <i class="bi bi-clipboard2-pulse me-1"></i> Especialidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=cita&action=index">
                            <i class="bi bi-calendar2-check me-1"></i> Citas
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-wrapper">