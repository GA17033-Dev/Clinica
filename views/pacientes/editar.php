<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Paciente</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?controller=paciente&action=editar&id=<?php echo $this->pacienteModel->id_paciente; ?>"
                        method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_completo">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre_completo"
                                        name="nombre_completo"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->nombre_completo); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->fecha_nacimiento); ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dui">DUI</label>
                                    <input type="text" class="form-control" id="dui" name="dui"
                                        pattern="[0-9]{9}" title="Ingrese 9 dígitos"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->dui); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        pattern="[0-9]{8}" title="Ingrese 8 dígitos"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->telefono); ?>"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->correo); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="<?php echo htmlspecialchars($this->pacienteModel->direccion); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="index.php?controller=paciente&action=index"
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