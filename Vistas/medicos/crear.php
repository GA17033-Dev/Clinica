<?php require_once 'Vistas/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-success bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Nuevo Médico</h5>
                            <p class="text-muted small mb-0">Complete el formulario para registrar un nuevo médico</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?controller=medico&action=crear" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-person me-2"></i>Información Personal
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombre_completo" 
                                               name="nombre_completo" placeholder="Nombre Completo" required>
                                        <label for="nombre_completo">Nombre Completo</label>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el nombre completo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="numero_jvpm" 
                                               name="numero_jvpm" pattern="[0-9]{5}" 
                                               placeholder="JVPM" required>
                                        <label for="numero_jvpm">Número JVPM</label>
                                        <div class="invalid-feedback">
                                            Ingrese un número JVPM válido de 5 dígitos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-clipboard2-pulse me-2"></i>Especialidad y Contacto
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="id_especialidad" 
                                                name="id_especialidad" required>
                                            <option value="">Seleccione una especialidad</option>
                                            <?php while ($especialidad = $especialidades->fetch(PDO::FETCH_ASSOC)): ?>
                                                <option value="<?php echo $especialidad['id_especialidad']; ?>">
                                                    <?php echo htmlspecialchars($especialidad['nombre_especialidad']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <label for="id_especialidad">Especialidad</label>
                                        <div class="invalid-feedback">
                                            Por favor seleccione una especialidad
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="telefono" 
                                               name="telefono" pattern="[0-9]{8}" 
                                               placeholder="Teléfono" required>
                                        <label for="telefono">Teléfono</label>
                                        <div class="invalid-feedback">
                                            Ingrese un número válido de 8 dígitos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-success mb-3">
                                <i class="bi bi-envelope me-2"></i>Información de Contacto
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="correo" 
                                               name="correo" placeholder="Correo" required>
                                        <label for="correo">Correo Electrónico</label>
                                        <div class="invalid-feedback">
                                            Ingrese un correo electrónico válido
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=medico&action=index" 
                               class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-2"></i>
                                Guardar Médico
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict'
    
    var forms = document.querySelectorAll('.needs-validation')
    
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

<?php require_once 'Vistas/templates/footer.php'; ?>