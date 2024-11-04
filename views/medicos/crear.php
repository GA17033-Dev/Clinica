<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registrar Nuevo Médico</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?controller=medico&action=crear" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_completo">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre_completo"
                                        name="nombre_completo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numero_jvpm">Número JVPM</label>
                                    <input type="text" class="form-control" id="numero_jvpm"
                                        name="numero_jvpm" pattern="[0-9]{5}"
                                        title="Ingrese 5 dígitos" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_especialidad">Especialidad</label>
                                    <select class="form-control" id="id_especialidad"
                                        name="id_especialidad" required>
                                        <option value="">Seleccione una especialidad</option>
                                        <?php while ($especialidad = $especialidades->fetch(PDO::FETCH_ASSOC)): ?>
                                            <option value="<?php echo $especialidad['id_especialidad']; ?>">
                                                <?php echo htmlspecialchars($especialidad['nombre_especialidad']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono"
                                        name="telefono" pattern="[0-9]{8}"
                                        title="Ingrese 8 dígitos" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo"
                                        name="correo" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="index.php?controller=medico&action=index"
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