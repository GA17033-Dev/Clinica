<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-info bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-calendar2-plus"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Reagendar Cita</h5>
                            <p class="text-muted small mb-0">Seleccione una nueva fecha y hora para la cita cancelada</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="text-info mb-3">
                                <i class="bi bi-info-circle me-2"></i>Detalles de la Cita Original
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary bg-gradient text-white me-2">
                                            <?php echo strtoupper(substr($cita['nombre_paciente'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($cita['nombre_paciente']); ?></div>
                                            <small class="text-muted">Paciente</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-info bg-gradient text-white me-2">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium"><?php echo htmlspecialchars($cita['nombre_medico']); ?></div>
                                            <small class="text-muted"><?php echo htmlspecialchars($cita['nombre_especialidad']); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-warning bg-gradient text-white me-2">
                                            <i class="bi bi-clipboard2-pulse"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium">Motivo de la consulta</div>
                                            <small class="text-muted"><?php echo htmlspecialchars($cita['motivo_consulta']); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="index.php?controller=cita&action=reagendar&id=<?php echo $this->citaModel->id_cita; ?>"
                        method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h6 class="text-info mb-3">
                                <i class="bi bi-calendar-check me-2"></i>Nueva Programación
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fecha_cita"
                                            name="fecha_cita" required
                                            min="<?php echo date('Y-m-d'); ?>">
                                        <label for="fecha_cita">Nueva Fecha</label>
                                        <div class="invalid-feedback">
                                            Seleccione una fecha válida
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="hora_cita"
                                            name="hora_cita" required>
                                        <label for="hora_cita">Nueva Hora</label>
                                        <div class="invalid-feedback">
                                            Seleccione una hora válida
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=cita&action=index"
                                class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-info text-white">
                                <i class="bi bi-check-circle me-2"></i>
                                Confirmar Reagendamiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php require_once 'views/templates/footer.php'; ?>