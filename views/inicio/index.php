<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="text-center mb-4">Sistema de Gestión Médica</h1>
            <p class="text-center text-muted mb-5">Gestione sus citas médicas de manera eficiente y organizada</p>
            
            <div class="row g-4">
                <!-- Tarjeta de Pacientes -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-gradient text-white mb-3 rounded-circle mx-auto" style="width: 50px; height: 50px; line-height: 50px;">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5 class="card-title mb-3">Pacientes</h5>
                            <p class="card-text text-muted mb-4">Gestión de información de pacientes</p>
                            <a href="index.php?controller=paciente&action=index" 
                               class="btn btn-outline-primary btn-sm stretched-link">
                                Gestionar Pacientes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Médicos -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-success bg-gradient text-white mb-3 rounded-circle mx-auto" style="width: 50px; height: 50px; line-height: 50px;">
                                <i class="bi bi-hospital"></i>
                            </div>
                            <h5 class="card-title mb-3">Médicos</h5>
                            <p class="card-text text-muted mb-4">Administración del personal médico</p>
                            <a href="index.php?controller=medico&action=index" 
                               class="btn btn-outline-success btn-sm stretched-link">
                                Gestionar Médicos
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Especialidades -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-info bg-gradient text-white mb-3 rounded-circle mx-auto" style="width: 50px; height: 50px; line-height: 50px;">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>
                            <h5 class="card-title mb-3">Especialidades</h5>
                            <p class="card-text text-muted mb-4">Control de especialidades médicas</p>
                            <a href="index.php?controller=especialidad&action=index" 
                               class="btn btn-outline-info btn-sm stretched-link">
                                Ver Especialidades
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Citas -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-warning bg-gradient text-white mb-3 rounded-circle mx-auto" style="width: 50px; height: 50px; line-height: 50px;">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <h5 class="card-title mb-3">Citas</h5>
                            <p class="card-text text-muted mb-4">Programación de citas médicas</p>
                            <a href="index.php?controller=cita&action=index" 
                               class="btn btn-outline-warning btn-sm stretched-link">
                                Gestionar Citas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/templates/footer.php'; ?>