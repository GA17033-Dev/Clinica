<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-clipboard2-pulse me-2 text-info"></i>
                                Especialidades Médicas
                            </h5>
                            <p class="text-muted small mb-0">Gestione las especialidades disponibles en la clínica</p>
                        </div>
                        <a href="index.php?controller=especialidad&action=crear" 
                           class="btn btn-info text-white">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nueva Especialidad
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <div class="table-responsive">
                        <table id="tablaEspecialidades" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th>Descripción</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $especialidades->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-info bg-gradient text-white me-2">
                                                    <?php echo strtoupper(substr($row['nombre_especialidad'], 0, 1)); ?>
                                                </div>
                                                <span class="fw-medium"><?php echo htmlspecialchars($row['nombre_especialidad']); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0">
                                                <?php echo htmlspecialchars($row['descripcion'] ?: 'Sin descripción'); ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="index.php?controller=especialidad&action=editar&id=<?php echo $row['id_especialidad']; ?>" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Editar especialidad">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal<?php echo $row['id_especialidad']; ?>"
                                                        title="Eliminar especialidad">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Modal de Confirmación -->
                                            <div class="modal fade" id="deleteModal<?php echo $row['id_especialidad']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="bi bi-exclamation-triangle text-warning display-3"></i>
                                                            <h5 class="mt-3">¿Está seguro de eliminar esta especialidad?</h5>
                                                            <p class="text-muted">Esta acción podría afectar a los médicos asociados.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                            <a href="index.php?controller=especialidad&action=eliminar&id=<?php echo $row['id_especialidad']; ?>" 
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

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaEspecialidades').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        pageLength: 10,
        order: [[0, 'asc']], // Ordenar por nombre de especialidad
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });

    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>

<?php require_once 'views/templates/footer.php'; ?>