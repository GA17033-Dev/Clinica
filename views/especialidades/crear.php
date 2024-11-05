<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="feature-icon bg-info bg-gradient text-white rounded-circle me-3">
                            <i class="bi bi-plus-circle-dotted"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Nueva Especialidad</h5>
                            <p class="text-muted small mb-0">Agregue una nueva especialidad médica al sistema</p>
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

                    <form action="index.php?controller=especialidad&action=crear" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h6 class="text-info mb-3">
                                <i class="bi bi-clipboard2-pulse me-2"></i>Información de la Especialidad
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nombre_especialidad"
                                            name="nombre_especialidad"
                                            placeholder="Nombre de la especialidad"
                                            required>
                                        <label for="nombre_especialidad">Nombre de la Especialidad</label>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el nombre de la especialidad
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="descripcion"
                                            name="descripcion"
                                            style="height: 100px"
                                            placeholder="Descripción"></textarea>
                                        <label for="descripcion">Descripción</label>
                                        <div class="form-text text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Proporcione una breve descripción de la especialidad
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=especialidad&action=index"
                                class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-info text-white">
                                <i class="bi bi-check-circle me-2"></i>
                                Guardar Especialidad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        const textarea = document.querySelector('#descripcion');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    })()
</script>



<?php require_once 'views/templates/footer.php'; ?>