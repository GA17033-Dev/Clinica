<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">
                                <i class="bi bi-people me-2 text-primary"></i>
                                Gestión de Pacientes
                            </h5>
                            <p class="text-muted small mb-0">Administre la información de los pacientes registrados</p>
                        </div>
                        <a href="index.php?controller=paciente&action=crear" 
                           class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nuevo Paciente
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaPacientes" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>DUI</th>
                                    <th>Nombre Completo</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $pacientes->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <?php echo htmlspecialchars($row['dui']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary me-2">
                                                    <?php echo strtoupper(substr($row['nombre_completo'], 0, 1)); ?>
                                                </div>
                                                <?php echo htmlspecialchars($row['nombre_completo']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($row['fecha_nacimiento'])); ?></td>
                                        <td>
                                            <a href="tel:<?php echo $row['telefono']; ?>" class="text-decoration-none">
                                                <i class="bi bi-telephone me-1"></i>
                                                <?php echo htmlspecialchars($row['telefono']); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="mailto:<?php echo $row['correo']; ?>" class="text-decoration-none">
                                                <i class="bi bi-envelope me-1"></i>
                                                <?php echo htmlspecialchars($row['correo']); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="index.php?controller=paciente&action=editar&id=<?php echo $row['id_paciente']; ?>" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Editar paciente">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal<?php echo $row['id_paciente']; ?>"
                                                        title="Eliminar paciente">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Modal de Confirmación -->
                                            <div class="modal fade" id="deleteModal<?php echo $row['id_paciente']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="bi bi-exclamation-triangle text-warning display-3"></i>
                                                            <h5 class="mt-3">¿Está seguro de eliminar este paciente?</h5>
                                                            <p class="text-muted">Esta acción no se puede deshacer.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                            <a href="index.php?controller=paciente&action=eliminar&id=<?php echo $row['id_paciente']; ?>" 
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

<!-- Agregar antes del cierre del body -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablaPacientes').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        pageLength: 10,
        order: [[1, 'asc']], // Ordenar por nombre
        columnDefs: [
            {
                targets: -1,
                orderable: false
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