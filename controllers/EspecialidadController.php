<?php
require_once 'models/Especialidad.php';

class EspecialidadController {
    private $especialidadModel;

    public function __construct() {
        $this->especialidadModel = new Especialidad();
    }

    public function index() {
        $especialidades = $this->especialidadModel->leer();
        require_once 'views/especialidades/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->especialidadModel->nombre_especialidad = $_POST['nombre_especialidad'];
            $this->especialidadModel->descripcion = $_POST['descripcion'];

            if($this->especialidadModel->existeNombre($_POST['nombre_especialidad'])) {
                $error = "Ya existe una especialidad con ese nombre.";
                require_once 'views/especialidades/crear.php';
                return;
            }

            if($this->especialidadModel->crear()) {
                header('Location: index.php?controller=especialidad&action=index');
            } else {
                $error = "Ocurrió un error al crear la especialidad.";
                require_once 'views/especialidades/crear.php';
            }
        } else {
            require_once 'views/especialidades/crear.php';
        }
    }

    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=especialidad&action=index');
            return;
        }

        $this->especialidadModel->id_especialidad = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->especialidadModel->nombre_especialidad = $_POST['nombre_especialidad'];
            $this->especialidadModel->descripcion = $_POST['descripcion'];

            if($this->especialidadModel->existeNombre($_POST['nombre_especialidad'], $_GET['id'])) {
                $error = "Ya existe una especialidad con ese nombre.";
                require_once 'views/especialidades/editar.php';
                return;
            }

            if($this->especialidadModel->actualizar()) {
                header('Location: index.php?controller=especialidad&action=index');
            } else {
                $error = "Ocurrió un error al actualizar la especialidad.";
                require_once 'views/especialidades/editar.php';
            }
        } else {
            if($this->especialidadModel->leerUno()) {
                require_once 'views/especialidades/editar.php';
            } else {
                header('Location: index.php?controller=especialidad&action=index');
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->especialidadModel->id_especialidad = $_GET['id'];
            if($this->especialidadModel->eliminar()) {
                header('Location: index.php?controller=especialidad&action=index');
            } else {
                $error = "No se puede eliminar la especialidad porque tiene médicos asociados.";
                $especialidades = $this->especialidadModel->leer();
                require_once 'views/especialidades/listar.php';
            }
        } else {
            header('Location: index.php?controller=especialidad&action=index');
        }
    }
}