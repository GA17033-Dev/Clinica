<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-start">Listado de Especialidades</h4>
                    <a href="index.php?controller=especialidad&action=crear" class="btn btn-primary float-end">
                        Nueva Especialidad
                    </a>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $especialidades->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['nombre_especialidad']); ?></td>
                                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                        <td>
                                            <a href="index.php?controller=especialidad&action=editar&id=<?php echo $row['id_especialidad']; ?>" 
                                               class="btn btn-sm btn-warning">
                                                Editar
                                            </a>
                                            <a href="index.php?controller=especialidad&action=eliminar&id=<?php echo $row['id_especialidad']; ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('¿Está seguro de eliminar esta especialidad?');">
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