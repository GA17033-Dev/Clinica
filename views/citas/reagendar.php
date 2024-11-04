
<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reagendar Cita Cancelada</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-info">
                        <h5>Información de la Cita</h5>
                        <p><strong>Paciente:</strong> <?php echo htmlspecialchars($cita['nombre_paciente']); ?></p>
                        <p><strong>Médico:</strong> <?php echo htmlspecialchars($cita['nombre_medico']); ?></p>
                        <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($cita['nombre_especialidad']); ?></p>
                        <p><strong>Motivo:</strong> <?php echo htmlspecialchars($cita['motivo_consulta']); ?></p>
                    </div>

                    <form action="index.php?controller=cita&action=reagendar&id=<?php echo $this->citaModel->id_cita; ?>" 
                          method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_cita">Nueva Fecha de la Cita</label>
                                    <input type="date" class="form-control" id="fecha_cita" 
                                           name="fecha_cita" required
                                           min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hora_cita">Nueva Hora de la Cita</label>
                                    <input type="time" class="form-control" id="hora_cita" 
                                           name="hora_cita" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Reagendar Cita</button>
                                <a href="index.php?controller=cita&action=index" 
                                   class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/templates/footer.php'; ?>