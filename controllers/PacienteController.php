<?php
require_once 'models/Paciente.php';

class PacienteController {
    private $pacienteModel;

    public function __construct() {
        $this->pacienteModel = new Paciente();
    }

    public function index() {
        $pacientes = $this->pacienteModel->leer();
        require_once 'views/pacientes/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->pacienteModel->nombre_completo = $_POST['nombre_completo'];
            $this->pacienteModel->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->pacienteModel->dui = $_POST['dui'];
            $this->pacienteModel->telefono = $_POST['telefono'];
            $this->pacienteModel->correo = $_POST['correo'];
            $this->pacienteModel->direccion = $_POST['direccion'];
            if($this->pacienteModel->existeDui($_POST['dui'])) {
                $error = "El DUI ya está registrado en el sistema.";
                require_once 'views/pacientes/crear.php';
                return;
            }

            if($this->pacienteModel->crear()) {
                header('Location: index.php?controller=paciente&action=index');
            } else {
                $error = "Ocurrió un error al crear el paciente.";
                require_once 'views/pacientes/crear.php';
            }
        } else {
            require_once 'views/pacientes/crear.php';
        }
    }

    public function editar() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=paciente&action=index');
            return;
        }

        $this->pacienteModel->id_paciente = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->pacienteModel->nombre_completo = $_POST['nombre_completo'];
            $this->pacienteModel->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $this->pacienteModel->dui = $_POST['dui'];
            $this->pacienteModel->telefono = $_POST['telefono'];
            $this->pacienteModel->correo = $_POST['correo'];
            $this->pacienteModel->direccion = $_POST['direccion'];

            if($this->pacienteModel->existeDui($_POST['dui'], $_GET['id'])) {
                $error = "El DUI ya está registrado en el sistema.";
                require_once 'views/pacientes/editar.php';
                return;
            }

            if($this->pacienteModel->actualizar()) {
                header('Location: index.php?controller=paciente&action=index');
            } else {
                $error = "Ocurrió un error al actualizar el paciente.";
                require_once 'views/pacientes/editar.php';
            }
        } else {
            if($this->pacienteModel->leerUno()) {
                require_once 'views/pacientes/editar.php';
            } else {
                header('Location: index.php?controller=paciente&action=index');
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->pacienteModel->id_paciente = $_GET['id'];
            if($this->pacienteModel->eliminar()) {
                header('Location: index.php?controller=paciente&action=index');
            } else {
                echo "Error al eliminar el paciente.";
            }
        }
        header('Location: index.php?controller=paciente&action=index');
    }
}