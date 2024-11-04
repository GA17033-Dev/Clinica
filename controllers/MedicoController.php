<?php
require_once 'models/Medico.php';
require_once 'models/Especialidad.php';

class MedicoController {
    private $medicoModel;
    private $especialidadModel;

    public function __construct() {
        $this->medicoModel = new Medico();
        $this->especialidadModel = new Especialidad();
    }

    public function index() {
        $medicos = $this->medicoModel->leer();
        require_once 'views/medicos/listar.php';
    }

    public function crear() {
        // Obtener lista de especialidades para el formulario
        $especialidades = $this->especialidadModel->leer();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->medicoModel->nombre_completo = $_POST['nombre_completo'];
            $this->medicoModel->numero_jvpm = $_POST['numero_jvpm'];
            $this->medicoModel->telefono = $_POST['telefono'];
            $this->medicoModel->correo = $_POST['correo'];
            $this->medicoModel->id_especialidad = $_POST['id_especialidad'];

            // Validar JVPM único
            if($this->medicoModel->existeJVPM($_POST['numero_jvpm'])) {
                $error = "El número JVPM ya está registrado en el sistema.";
                require_once 'views/medicos/crear.php';
                return;
            }

            if($this->medicoModel->crear()) {
                header('Location: index.php?controller=medico&action=index');
            } else {
                $error = "Ocurrió un error al crear el médico.";
                require_once 'views/medicos/crear.php';
            }
        } else {
            require_once 'views/medicos/crear.php';
        }
    }

    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=medico&action=index');
            return;
        }

        // Obtener lista de especialidades para el formulario
        $especialidades = $this->especialidadModel->leer();
        $this->medicoModel->id_medico = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->medicoModel->nombre_completo = $_POST['nombre_completo'];
            $this->medicoModel->numero_jvpm = $_POST['numero_jvpm'];
            $this->medicoModel->telefono = $_POST['telefono'];
            $this->medicoModel->correo = $_POST['correo'];
            $this->medicoModel->id_especialidad = $_POST['id_especialidad'];

            // Validar JVPM único excluyendo el ID actual
            if($this->medicoModel->existeJVPM($_POST['numero_jvpm'], $_GET['id'])) {
                $error = "El número JVPM ya está registrado en el sistema.";
                require_once 'views/medicos/editar.php';
                return;
            }

            if($this->medicoModel->actualizar()) {
                header('Location: index.php?controller=medico&action=index');
            } else {
                $error = "Ocurrió un error al actualizar el médico.";
                require_once 'views/medicos/editar.php';
            }
        } else {
            if($this->medicoModel->leerUno()) {
                require_once 'views/medicos/editar.php';
            } else {
                header('Location: index.php?controller=medico&action=index');
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->medicoModel->id_medico = $_GET['id'];
            if($this->medicoModel->eliminar()) {
                header('Location: index.php?controller=medico&action=index');
            } else {
                echo "Error al eliminar el médico.";
            }
        }
        header('Location: index.php?controller=medico&action=index');
    }
}