<?php
require_once 'models/Cita.php';
require_once 'models/Paciente.php';
require_once 'models/Medico.php';

class CitaController
{
    private $citaModel;
    private $pacienteModel;
    private $medicoModel;

    public function __construct()
    {
        $this->citaModel = new Cita();
        $this->pacienteModel = new Paciente();
        $this->medicoModel = new Medico();
    }

    public function index()
    {
        $estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : 'programada';
        $citas = $this->citaModel->leer($estado_filtro);
        require_once 'views/citas/listar.php';
    }

    public function crear()
    {
        // Obtener listas para los formularios
        $pacientes = $this->pacienteModel->leer();
        $medicos = $this->medicoModel->leer();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->citaModel->fecha_cita = $_POST['fecha_cita'];
            $this->citaModel->hora_cita = $_POST['hora_cita'];
            $this->citaModel->id_paciente = $_POST['id_paciente'];
            $this->citaModel->id_medico = $_POST['id_medico'];
            $this->citaModel->motivo_consulta = $_POST['motivo_consulta'];
            $this->citaModel->estado_cita = 'programada';
            $this->citaModel->observaciones = $_POST['observaciones'];

            if ($this->citaModel->crear()) {
                header('Location: index.php?controller=cita&action=index');
            } else {
                $error = "El horario seleccionado no está disponible para este médico.";
                require_once 'views/citas/crear.php';
            }
        } else {
            require_once 'views/citas/crear.php';
        }
    }

    public function editar()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=cita&action=index');
            return;
        }

        // Obtener listas para los formularios
        $pacientes = $this->pacienteModel->leer();
        $medicos = $this->medicoModel->leer();

        $this->citaModel->id_cita = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->citaModel->fecha_cita = $_POST['fecha_cita'];
            $this->citaModel->hora_cita = $_POST['hora_cita'];
            $this->citaModel->id_paciente = $_POST['id_paciente'];
            $this->citaModel->id_medico = $_POST['id_medico'];
            $this->citaModel->estado_cita = $_POST['estado_cita'];
            $this->citaModel->motivo_consulta = $_POST['motivo_consulta'];
            $this->citaModel->observaciones = $_POST['observaciones'];

            if ($this->citaModel->actualizar()) {
                header('Location: index.php?controller=cita&action=index');
            } else {
                $error = "El horario seleccionado no está disponible para este médico.";
                $cita = $this->citaModel->leerUno();
                require_once 'views/citas/editar.php';
            }
        } else {
            $cita = $this->citaModel->leerUno();
            if ($cita) {
                require_once 'views/citas/editar.php';
            } else {
                header('Location: index.php?controller=cita&action=index');
            }
        }
    }

    public function cambiarEstado()
    {
        if (!isset($_GET['id']) || !isset($_GET['estado'])) {
            header('Location: index.php?controller=cita&action=index');
            return;
        }

        $this->citaModel->id_cita = $_GET['id'];
        $nuevo_estado = $_GET['estado'];

        // Validar que el estado sea válido
        $estados_validos = ['programada', 'completada', 'cancelada'];
        if (!in_array($nuevo_estado, $estados_validos)) {
            header('Location: index.php?controller=cita&action=index');
            return;
        }

        if ($this->citaModel->cambiarEstado($nuevo_estado)) {
            header('Location: index.php?controller=cita&action=index');
        } else {
            $error = "Error al cambiar el estado de la cita.";
            $citas = $this->citaModel->leer();
            require_once 'views/citas/listar.php';
        }
    }

    public function reagendar()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=cita&action=index');
            return;
        }

        $this->citaModel->id_cita = $_GET['id'];
        $cita = $this->citaModel->leerUno();

        if (!$cita || $cita['estado_cita'] != 'cancelada') {
            header('Location: index.php?controller=cita&action=index');
            return;
        }

        $medicos = $this->medicoModel->leer();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->citaModel->fecha_cita = $_POST['fecha_cita'];
            $this->citaModel->hora_cita = $_POST['hora_cita'];
            $this->citaModel->estado_cita = 'programada';

            if ($this->citaModel->actualizar()) {
                header('Location: index.php?controller=cita&action=index');
            } else {
                $error = "El horario seleccionado no está disponible.";
                require_once 'views/citas/reagendar.php';
            }
        } else {
            require_once 'views/citas/reagendar.php';
        }
    }
}
