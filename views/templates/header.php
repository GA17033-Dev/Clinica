<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Citas Médicas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link href="public/css/CARNET_L2_ClaveX.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Clínica Médica</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=paciente&action=index">Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=medico&action=index">Médicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=especialidad&action=index">Especialidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=cita&action=index">Citas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>