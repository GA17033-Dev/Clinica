<?php require_once 'Vistas/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-warning bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-calendar2-week"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Modificar Cita Médica</h5>
                            <p class="text-muted small mb-0">Actualice los detalles de la cita programada</p>
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

                    <form action="index.php?controller=cita&action=editar&id=<?php echo $this->citaModel->id_cita; ?>"
                        method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-people me-2"></i>Información de Participantes
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_paciente" name="id_paciente" required>
                                            <option value="">Seleccione un paciente</option>
                                            <?php while ($paciente = $pacientes->fetch(PDO::FETCH_ASSOC)): ?>
                                                <option value="<?php echo $paciente['id_paciente']; ?>"
                                                    <?php echo ($this->citaModel->id_paciente == $paciente['id_paciente']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($paciente['nombre_completo'] . ' - DUI: ' . $paciente['dui']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="id_paciente">Paciente</label>
                                        <div class="invalid-feedback">Por favor seleccione un paciente</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_medico" name="id_medico" required>
                                            <option value="">Seleccione un médico</option>
                                            <?php while ($medico = $medicos->fetch(PDO::FETCH_ASSOC)): ?>
                                                <option value="<?php echo $medico['id_medico']; ?>"
                                                    <?php echo ($this->citaModel->id_medico == $medico['id_medico']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($medico['nombre_completo'] . ' - ' . $medico['nombre_especialidad']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="id_medico">Médico</label>
                                        <div class="invalid-feedback">Por favor seleccione un médico</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-clock-history me-2"></i>Programación y Estado
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fecha_cita"
                                            name="fecha_cita" required
                                            min="<?php echo date('Y-m-d'); ?>"
                                            value="<?php echo htmlspecialchars($this->citaModel->fecha_cita); ?>">
                                        <label for="fecha_cita">Fecha de la Cita</label>
                                        <div class="invalid-feedback">Seleccione una fecha válida</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="hora_cita"
                                            name="hora_cita" required
                                            value="<?php echo htmlspecialchars($this->citaModel->hora_cita); ?>">
                                        <label for="hora_cita">Hora de la Cita</label>
                                        <div class="invalid-feedback">Seleccione una hora válida</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="estado_cita" name="estado_cita" required>
                                            <option value="programada" <?php echo ($this->citaModel->estado_cita == 'programada') ? 'selected' : ''; ?>>
                                                Programada
                                            </option>
                                            <option value="completada" <?php echo ($this->citaModel->estado_cita == 'completada') ? 'selected' : ''; ?>>
                                                Completada
                                            </option>
                                            <option value="cancelada" <?php echo ($this->citaModel->estado_cita == 'cancelada') ? 'selected' : ''; ?>>
                                                Cancelada
                                            </option>
                                        </select>
                                        <label for="estado_cita">Estado de la Cita</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-warning mb-3">
                                <i class="bi bi-clipboard2-pulse me-2"></i>Detalles de la Consulta
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="motivo_consulta"
                                            name="motivo_consulta" style="height: 100px"
                                            required><?php echo htmlspecialchars($this->citaModel->motivo_consulta); ?></textarea>
                                        <label for="motivo_consulta">Motivo de la Consulta</label>
                                        <div class="invalid-feedback">Por favor indique el motivo de la consulta</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="observaciones"
                                            name="observaciones" style="height: 100px"><?php echo htmlspecialchars($this->citaModel->observaciones); ?></textarea>
                                        <label for="observaciones">Observaciones</label>
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
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="bi bi-check-circle me-2"></i>
                                Actualizar Cita
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
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            textarea.dispatchEvent(new Event('input'));
        });
    })()
</script>

<?php require_once 'Vistas/templates/footer.php'; ?>