<?php require_once 'Vistas/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Nuevo Paciente</h5>
                            <p class="text-muted small mb-0">Complete el formulario para registrar un nuevo paciente</p>
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

                    <form action="index.php?controller=paciente&action=crear" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">Información Personal</h6>
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
                                        <input type="date" class="form-control" id="fecha_nacimiento" 
                                               name="fecha_nacimiento" required>
                                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                        <div class="invalid-feedback">
                                            Seleccione una fecha válida
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documentación -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">Documentación e Identificación</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="dui" name="dui" 
                                               pattern="[0-9]{9}" placeholder="DUI" required>
                                        <label for="dui">DUI</label>
                                        <div class="invalid-feedback">
                                            Ingrese un DUI válido de 9 dígitos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="telefono" name="telefono" 
                                               pattern="[0-9]{8}" placeholder="Teléfono" required>
                                        <label for="telefono">Teléfono</label>
                                        <div class="invalid-feedback">
                                            Ingrese un número válido de 8 dígitos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contacto -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">Información de Contacto</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="correo" 
                                               name="correo" placeholder="Correo">
                                        <label for="correo">Correo Electrónico</label>
                                        <div class="invalid-feedback">
                                            Ingrese un correo válido
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="direccion" 
                                               name="direccion" placeholder="Dirección">
                                        <label for="direccion">Dirección</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=paciente&action=index" 
                               class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>
                                Guardar Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación del formulario
(function () {
    'use strict'
    
    // Fetch all forms to apply validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    
    // Loop over them and prevent submission
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