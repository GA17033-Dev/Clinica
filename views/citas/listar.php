<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-2 mb-md-0">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar2-week me-2 text-primary"></i>
                                Agenda Médica
                            </h5>
                            <p class="text-muted small mb-0">Gestione las citas médicas programadas</p>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="btn-group shadow-sm">
                                <a href="index.php?controller=cita&action=index&estado=programada" 
                                   class="btn <?php echo (!isset($_GET['estado']) || $_GET['estado'] == 'programada') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Programadas
                                    <span class="badge bg-white text-primary ms-1">12</span>
                                </a>
                                <a href="index.php?controller=cita&action=index&estado=completada" 
                                   class="btn <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'completada') ? 'btn-success' : 'btn-outline-success'; ?>">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Completadas
                                </a>
                                <a href="index.php?controller=cita&action=index&estado=cancelada" 
                                   class="btn <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'cancelada') ? 'btn-danger' : 'btn-outline-danger'; ?>">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Canceladas
                                </a>
                            </div>
                            <a href="index.php?controller=cita&action=crear" class="btn btn-primary shadow-sm">
                                <i class="bi bi-plus-circle me-2"></i>
                                Nueva Cita
                            </a>
                        </div>
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
                        <table id="tablaCitas" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $citas->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="calendar-icon me-3 text-primary">
                                                    <div class="calendar-month"><?php echo strtoupper(date('M', strtotime($row['fecha_cita']))); ?></div>
                                                    <div class="calendar-day"><?php echo date('d', strtotime($row['fecha_cita'])); ?></div>
                                                </div>
                                                <div>
                                                    <div class="fw-medium"><?php echo date('h:i A', strtotime($row['hora_cita'])); ?></div>
                                                    <small class="text-muted"><?php echo date('l', strtotime($row['fecha_cita'])); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary bg-gradient text-white me-2">
                                                    <?php echo strtoupper(substr($row['nombre_paciente'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <div class="fw-medium"><?php echo htmlspecialchars($row['nombre_paciente']); ?></div>
                                                    <small class="text-muted">DUI: <?php echo htmlspecialchars($row['dui']); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-info bg-gradient text-white me-2">
                                                    <i class="bi bi-person-badge"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-medium"><?php echo htmlspecialchars($row['nombre_medico']); ?></div>
                                                    <small class="text-muted"><?php echo htmlspecialchars($row['nombre_especialidad']); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill <?php 
                                                echo $row['estado_cita'] == 'programada' ? 'bg-primary-subtle text-primary' : 
                                                    ($row['estado_cita'] == 'completada' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'); 
                                            ?>">
                                                <i class="bi <?php 
                                                    echo $row['estado_cita'] == 'programada' ? 'bi-calendar-check' : 
                                                        ($row['estado_cita'] == 'completada' ? 'bi-check-circle' : 'bi-x-circle'); 
                                                ?> me-1"></i>
                                                <?php echo ucfirst($row['estado_cita']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <?php if($row['estado_cita'] == 'programada'): ?>
                                                    <a href="index.php?controller=cita&action=editar&id=<?php echo $row['id_cita']; ?>" 
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Editar cita">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-success"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#completarModal<?php echo $row['id_cita']; ?>"
                                                            title="Marcar como completada">
                                                        <i class="bi bi-check-lg"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#cancelarModal<?php echo $row['id_cita']; ?>"
                                                            title="Cancelar cita">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                <?php elseif($row['estado_cita'] == 'cancelada'): ?>
                                                    <a href="index.php?controller=cita&action=reagendar&id=<?php echo $row['id_cita']; ?>" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Reagendar cita">
                                                        <i class="bi bi-calendar-plus"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal fade" id="completarModal<?php echo $row['id_cita']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Completar Cita</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="bi bi-check-circle text-success display-3"></i>
                                                            <h5 class="mt-3">¿Marcar esta cita como completada?</h5>
                                                            <p class="text-muted">Confirme que la cita se ha llevado a cabo exitosamente.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                            <a href="index.php?controller=cita&action=cambiarEstado&id=<?php echo $row['id_cita']; ?>&estado=completada" 
                                                               class="btn btn-success">Completar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="cancelarModal<?php echo $row['id_cita']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Cancelar Cita</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="bi bi-exclamation-triangle text-warning display-3"></i>
                                                            <h5 class="mt-3">¿Está seguro de cancelar esta cita?</h5>
                                                            <p class="text-muted">Esta acción permitirá reagendar la cita posteriormente.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Volver</button>
                                                            <a href="index.php?controller=cita&action=cambiarEstado&id=<?php echo $row['id_cita']; ?>&estado=cancelada" 
                                                               class="btn btn-danger">Cancelar Cita</a>
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
    $('#tablaCitas').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        order: [[0, 'asc']],
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                searchable: false
            }
        ]
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
         return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>