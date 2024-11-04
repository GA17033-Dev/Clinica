<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Bienvenido al Sistema de Gestión de Citas Médicas</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Pacientes</h5>
                                    <p class="card-text">Administre la información de los pacientes registrados en el sistema.</p>
                                    <a href="index.php?controller=paciente&action=index" class="btn btn-primary">
                                        Ir a Pacientes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Médicos</h5>
                                    <p class="card-text">Administre la información de los médicos y sus especialidades.</p>
                                    <a href="index.php?controller=medico&action=index" class="btn btn-primary">
                                        Ir a Médicos
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Especialidades</h5>
                                    <p class="card-text">Administre las especialidades médicas disponibles.</p>
                                    <a href="index.php?controller=especialidad&action=index" class="btn btn-primary">
                                        Ir a Especialidades
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Citas</h5>
                                    <p class="card-text">Administre las citas médicas y su estado.</p>
                                    <a href="index.php?controller=cita&action=index" class="btn btn-primary">
                                        Ir a Citas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/templates/footer.php'; ?>