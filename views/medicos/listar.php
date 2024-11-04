
<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-start">Listado de Médicos</h4>
                    <a href="index.php?controller=medico&action=crear" class="btn btn-primary float-end">
                        Nuevo Médico
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>JVPM</th>
                                    <th>Nombre Completo</th>
                                    <th>Especialidad</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $medicos->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['numero_jvpm']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_completo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_especialidad']); ?></td>
                                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                                        <td>
                                            <a href="index.php?controller=medico&action=editar&id=<?php echo $row['id_medico']; ?>" 
                                               class="btn btn-sm btn-warning">
                                                Editar
                                            </a>
                                            <a href="index.php?controller=medico&action=eliminar&id=<?php echo $row['id_medico']; ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('¿Está seguro de eliminar este médico?');">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/templates/footer.php'; ?>
