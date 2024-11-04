

<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Listado de Citas</h4>
                        <div>
                            <div class="btn-group" role="group">
                                <a href="index.php?controller=cita&action=index&estado=programada" 
                                   class="btn btn-outline-primary <?php echo (!isset($_GET['estado']) || $_GET['estado'] == 'programada') ? 'active' : ''; ?>">
                                    Programadas
                                </a>
                                <a href="index.php?controller=cita&action=index&estado=completada" 
                                   class="btn btn-outline-primary <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'completada') ? 'active' : ''; ?>">
                                    Completadas
                                </a>
                                <a href="index.php?controller=cita&action=index&estado=cancelada" 
                                   class="btn btn-outline-primary <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'cancelada') ? 'active' : ''; ?>">
                                    Canceladas
                                </a>
                            </div>
                            <a href="index.php?controller=cita&action=crear" class="btn btn-primary ms-2">
                                Nueva Cita
                            </a>
                        </div>
                    </div>
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
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>DUI</th>
                                    <th>Médico</th>
                                    <th>Especialidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $citas->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo date('d/m/Y', strtotime($row['fecha_cita'])); ?></td>
                                        <td><?php echo date('h:i A', strtotime($row['hora_cita'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_paciente']); ?></td>
                                        <td><?php echo htmlspecialchars($row['dui']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_medico']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_especialidad']); ?></td>
                                        <td>
                                            <span class="badge <?php 
                                                echo $row['estado_cita'] == 'programada' ? 'bg-primary' : 
                                                    ($row['estado_cita'] == 'completada' ? 'bg-success' : 'bg-danger'); 
                                            ?>">
                                                <?php echo ucfirst($row['estado_cita']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($row['estado_cita'] == 'programada'): ?>
                                                <div class="btn-group">
                                                    <a href="index.php?controller=cita&action=editar&id=<?php echo $row['id_cita']; ?>" 
                                                       class="btn btn-sm btn-warning">
                                                        Editar
                                                    </a>
                                                    <a href="index.php?controller=cita&action=cambiarEstado&id=<?php echo $row['id_cita']; ?>&estado=completada" 
                                                       class="btn btn-sm btn-success"
                                                       onclick="return confirm('¿Marcar esta cita como completada?');">
                                                        Completar
                                                    </a>
                                                    <a href="index.php?controller=cita&action=cambiarEstado&id=<?php echo $row['id_cita']; ?>&estado=cancelada" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('¿Está seguro de cancelar esta cita?');">
                                                        Cancelar
                                                    </a>
                                                </div>
                                            <?php elseif($row['estado_cita'] == 'cancelada'): ?>
                                                <a href="index.php?controller=cita&action=reagendar&id=<?php echo $row['id_cita']; ?>" 
                                                   class="btn btn-sm btn-primary">
                                                    Reagendar
                                                </a>
                                            <?php endif; ?>
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

