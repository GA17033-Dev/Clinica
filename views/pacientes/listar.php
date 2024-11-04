<!-- views/pacientes/listar.php -->
<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-start">Listado de Pacientes</h4>
                    <a href="index.php?controller=paciente&action=crear" class="btn btn-primary float-end">
                        Nuevo Paciente
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>DUI</th>
                                    <th>Nombre Completo</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $pacientes->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['dui']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_completo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                                        <td>
                                            <a href="index.php?controller=paciente&action=editar&id=<?php echo $row['id_paciente']; ?>" 
                                               class="btn btn-sm btn-warning">
                                                Editar
                                            </a>
                                            <a href="index.php?controller=paciente&action=eliminar&id=<?php echo $row['id_paciente']; ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('¿Está seguro de eliminar este paciente?');">
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

