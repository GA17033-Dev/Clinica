<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-calendar-plus"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Agendar Nueva Cita</h5>
                            <p class="text-muted small mb-0">Complete el formulario para programar una nueva cita médica</p>
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

                    <form action="index.php?controller=cita&action=crear" method="POST" class="needs-validation" novalidate>

                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-people me-2"></i>Participantes de la Cita
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select select2" id="id_paciente" name="id_paciente" required>
                                            <option value="">Seleccione un paciente</option>
                                            <?php while ($paciente = $pacientes->fetch(PDO::FETCH_ASSOC)): ?>
                                                <option value="<?php echo $paciente['id_paciente']; ?>">
                                                    <?php echo htmlspecialchars($paciente['nombre_completo'] . ' - DUI: ' . $paciente['dui']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="id_paciente">Seleccione el Paciente</label>
                                        <div class="invalid-feedback">Por favor seleccione un paciente</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select select2" id="id_medico" name="id_medico" required>
                                            <option value="">Seleccione un médico</option>
                                            <?php while ($medico = $medicos->fetch(PDO::FETCH_ASSOC)): ?>
                                                <option value="<?php echo $medico['id_medico']; ?>">
                                                    <?php echo htmlspecialchars($medico['nombre_completo'] . ' - ' . $medico['nombre_especialidad']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="id_medico">Seleccione el Médico</label>
                                        <div class="invalid-feedback">Por favor seleccione un médico</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-clock me-2"></i>Programación de la Cita
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fecha_cita"
                                            name="fecha_cita" required
                                            min="<?php echo date('Y-m-d'); ?>">
                                        <label for="fecha_cita">Fecha de la Cita</label>
                                        <div class="invalid-feedback">Seleccione una fecha válida</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="hora_cita"
                                            name="hora_cita" required>
                                        <label for="hora_cita">Hora de la Cita</label>
                                        <div class="invalid-feedback">Seleccione una hora válida</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-clipboard-pulse me-2"></i>Detalles de la Consulta
                            </h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="motivo_consulta"
                                            name="motivo_consulta" style="height: 100px" required></textarea>
                                        <label for="motivo_consulta">Motivo de la Consulta</label>
                                        <div class="invalid-feedback">Por favor indique el motivo de la consulta</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="observaciones"
                                            name="observaciones" style="height: 100px"></textarea>
                                        <label for="observaciones">Observaciones Adicionales</label>
                                    </div>
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Incluya cualquier información adicional relevante para la cita
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
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>
                                Agendar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

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

            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
        })()
    });
</script>

<?php require_once 'views/templates/footer.php'; ?>