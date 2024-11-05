<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-hospital me-2 text-success"></i>
                                Personal Médico
                            </h5>
                            <p class="text-muted small mb-0">Gestione la información de los médicos y especialidades</p>
                        </div>
                        <a href="index.php?controller=medico&action=crear" 
                           class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nuevo Médico
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaMedicos" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>JVPM</th>
                                    <th>Médico</th>
                                    <th>Especialidad</th>
                                    <th>Contacto</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $medicos->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">
                                                <?php echo htmlspecialchars($row['numero_jvpm']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-success bg-gradient text-white me-2">
                                                    <?php echo strtoupper(substr($row['nombre_completo'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <span class="d-block"><?php echo htmlspecialchars($row['nombre_completo']); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clipboard2-pulse text-success me-2"></i>
                                                <?php echo htmlspecialchars($row['nombre_especialidad']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="tel:<?php echo $row['telefono']; ?>" 
                                                   class="text-decoration-none mb-1">
                                                    <i class="bi bi-telephone text-success me-2"></i>
                                                    <?php echo htmlspecialchars($row['telefono']); ?>
                                                </a>
                                                <a href="mailto:<?php echo $row['correo']; ?>" 
                                                   class="text-decoration-none text-muted small">
                                                    <i class="bi bi-envelope text-success me-2"></i>
                                                    <?php echo htmlspecialchars($row['correo']); ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="index.php?controller=medico&action=editar&id=<?php echo $row['id_medico']; ?>" 
                                                   class="btn btn-sm btn-outline-success" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Editar médico">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal<?php echo $row['id_medico']; ?>"
                                                        title="Eliminar médico">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            <div class="modal fade" id="deleteModal<?php echo $row['id_medico']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="bi bi-exclamation-triangle text-warning display-3"></i>
                                                            <h5 class="mt-3">¿Está seguro de eliminar este médico?</h5>
                                                            <p class="text-muted">Esta acción no se puede deshacer.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                            <a href="index.php?controller=medico&action=eliminar&id=<?php echo $row['id_medico']; ?>" 
                                                               class="btn btn-danger">Eliminar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<script>
$(document).ready(function() {
    $('#tablaMedicos').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        pageLength: 10,
        order: [[1, 'asc']],
        columnDefs: [
            {
                targets: -1,
                orderable: false
            }
        ]
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>

<?php require_once 'views/templates/footer.php'; ?>