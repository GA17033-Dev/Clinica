<!-- views/citas/editar.php -->
<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Cita</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?controller=cita&action=editar&id=<?php echo $this->citaModel->id_cita; ?>" 
                          method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_paciente">Paciente</label>
                                    <select class="form-control" id="id_paciente" name="id_paciente" required>
                                        <option value="">Seleccione un paciente</option>
                                        <?php while ($paciente = $pacientes->fetch(PDO::FETCH_ASSOC)): ?>
                                            <option value="<?php echo $paciente['id_paciente']; ?>"
                                                <?php echo ($this->citaModel->id_paciente == $paciente['id_paciente']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($paciente['nombre_completo'] . ' - DUI: ' . $paciente['dui']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_medico">Médico</label>
                                    <select class="form-control" id="id_medico" name="id_medico" required>
                                        <option value="">Seleccione un médico</option>
                                        <?php while ($medico = $medicos->fetch(PDO::FETCH_ASSOC)): ?>
                                            <option value="<?php echo $medico['id_medico']; ?>"
                                                <?php echo ($this->citaModel->id_medico == $medico['id_medico']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($medico['nombre_completo'] . ' - ' . $medico['nombre_especialidad']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_cita">Fecha de la Cita</label>
                                    <input type="date" class="form-control" id="fecha_cita" 
                                           name="fecha_cita" required
                                           min="<?php echo date('Y-m-d'); ?>"
                                           value="<?php echo htmlspecialchars($this->citaModel->fecha_cita); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hora_cita">Hora de la Cita</label>
                                    <input type="time" class="form-control" id="hora_cita" 
                                           name="hora_cita" required
                                           value="<?php echo htmlspecialchars($this->citaModel->hora_cita); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado_cita">Estado de la Cita</label>
                                    <select class="form-control" id="estado_cita" name="estado_cita" required>
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
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="motivo_consulta">Motivo de la Consulta</label>
                                    <textarea class="form-control" id="motivo_consulta" 
                                              name="motivo_consulta" rows="3" required><?php echo htmlspecialchars($this->citaModel->motivo_consulta); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <textarea class="form-control" id="observaciones" 
                                              name="observaciones" rows="3"><?php echo htmlspecialchars($this->citaModel->observaciones); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
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

