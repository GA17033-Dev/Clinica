<?php
require_once 'config/database.php';

class Cita {
    private $conn;
    private $table_name = "citas";

    // Propiedades
    public $id_cita;
    public $fecha_cita;
    public $hora_cita;
    public $id_paciente;
    public $id_medico;
    public $estado_cita;
    public $motivo_consulta;
    public $observaciones;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear nueva cita
    public function crear() {
        // Verificar disponibilidad antes de crear
        if($this->existeCitaEnHorario()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                (fecha_cita, hora_cita, id_paciente, id_medico, estado_cita, motivo_consulta, observaciones) 
                VALUES 
                (:fecha_cita, :hora_cita, :id_paciente, :id_medico, :estado_cita, :motivo_consulta, :observaciones)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar datos
        $this->fecha_cita = htmlspecialchars(strip_tags($this->fecha_cita));
        $this->hora_cita = htmlspecialchars(strip_tags($this->hora_cita));
        $this->id_paciente = htmlspecialchars(strip_tags($this->id_paciente));
        $this->id_medico = htmlspecialchars(strip_tags($this->id_medico));
        $this->estado_cita = htmlspecialchars(strip_tags($this->estado_cita));
        $this->motivo_consulta = htmlspecialchars(strip_tags($this->motivo_consulta));
        $this->observaciones = htmlspecialchars(strip_tags($this->observaciones));

        // Vincular valores
        $stmt->bindParam(":fecha_cita", $this->fecha_cita);
        $stmt->bindParam(":hora_cita", $this->hora_cita);
        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":id_medico", $this->id_medico);
        $stmt->bindParam(":estado_cita", $this->estado_cita);
        $stmt->bindParam(":motivo_consulta", $this->motivo_consulta);
        $stmt->bindParam(":observaciones", $this->observaciones);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Leer todas las citas con información relacionada
    public function leer($filtro_estado = null) {
        $query = "SELECT c.*, p.nombre_completo as nombre_paciente, p.dui, 
                         m.nombre_completo as nombre_medico, e.nombre_especialidad
                FROM " . $this->table_name . " c
                INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                INNER JOIN medicos m ON c.id_medico = m.id_medico
                INNER JOIN especialidades e ON m.id_especialidad = e.id_especialidad
                WHERE 1=1";

        if($filtro_estado) {
            $query .= " AND c.estado_cita = :estado_cita";
        }

        $query .= " ORDER BY c.fecha_cita ASC, c.hora_cita ASC";
        
        $stmt = $this->conn->prepare($query);

        if($filtro_estado) {
            $stmt->bindParam(":estado_cita", $filtro_estado);
        }

        $stmt->execute();
        return $stmt;
    }

    // Leer una cita específica
    public function leerUno() {
        $query = "SELECT c.*, p.nombre_completo as nombre_paciente, p.dui, 
                         m.nombre_completo as nombre_medico, e.nombre_especialidad
                FROM " . $this->table_name . " c
                INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                INNER JOIN medicos m ON c.id_medico = m.id_medico
                INNER JOIN especialidades e ON m.id_especialidad = e.id_especialidad
                WHERE c.id_cita = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_cita);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->fecha_cita = $row['fecha_cita'];
            $this->hora_cita = $row['hora_cita'];
            $this->id_paciente = $row['id_paciente'];
            $this->id_medico = $row['id_medico'];
            $this->estado_cita = $row['estado_cita'];
            $this->motivo_consulta = $row['motivo_consulta'];
            $this->observaciones = $row['observaciones'];
            return $row;
        }
        return false;
    }

    // Actualizar cita
    public function actualizar() {
        // Verificar disponibilidad antes de actualizar
        if($this->existeCitaEnHorario(true)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " 
                SET fecha_cita = :fecha_cita,
                    hora_cita = :hora_cita,
                    id_paciente = :id_paciente,
                    id_medico = :id_medico,
                    estado_cita = :estado_cita,
                    motivo_consulta = :motivo_consulta,
                    observaciones = :observaciones
                WHERE id_cita = :id_cita";

        $stmt = $this->conn->prepare($query);

        // Sanitizar datos
        $this->fecha_cita = htmlspecialchars(strip_tags($this->fecha_cita));
        $this->hora_cita = htmlspecialchars(strip_tags($this->hora_cita));
        $this->id_paciente = htmlspecialchars(strip_tags($this->id_paciente));
        $this->id_medico = htmlspecialchars(strip_tags($this->id_medico));
        $this->estado_cita = htmlspecialchars(strip_tags($this->estado_cita));
        $this->motivo_consulta = htmlspecialchars(strip_tags($this->motivo_consulta));
        $this->observaciones = htmlspecialchars(strip_tags($this->observaciones));
        $this->id_cita = htmlspecialchars(strip_tags($this->id_cita));

        // Vincular valores
        $stmt->bindParam(":fecha_cita", $this->fecha_cita);
        $stmt->bindParam(":hora_cita", $this->hora_cita);
        $stmt->bindParam(":id_paciente", $this->id_paciente);
        $stmt->bindParam(":id_medico", $this->id_medico);
        $stmt->bindParam(":estado_cita", $this->estado_cita);
        $stmt->bindParam(":motivo_consulta", $this->motivo_consulta);
        $stmt->bindParam(":observaciones", $this->observaciones);
        $stmt->bindParam(":id_cita", $this->id_cita);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cambiar estado de la cita
    public function cambiarEstado($nuevo_estado) {
        $query = "UPDATE " . $this->table_name . " 
                SET estado_cita = :estado_cita
                WHERE id_cita = :id_cita";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":estado_cita", $nuevo_estado);
        $stmt->bindParam(":id_cita", $this->id_cita);

        return $stmt->execute();
    }

    // Verificar si existe una cita en el mismo horario
    private function existeCitaEnHorario($excluir_actual = false) {
        $query = "SELECT COUNT(*) as count 
                FROM " . $this->table_name . " 
                WHERE id_medico = :id_medico 
                AND fecha_cita = :fecha_cita 
                AND hora_cita = :hora_cita 
                AND estado_cita = 'programada'";

        if($excluir_actual) {
            $query .= " AND id_cita != :id_cita";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_medico", $this->id_medico);
        $stmt->bindParam(":fecha_cita", $this->fecha_cita);
        $stmt->bindParam(":hora_cita", $this->hora_cita);

        if($excluir_actual) {
            $stmt->bindParam(":id_cita", $this->id_cita);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'] > 0;
    }

    // Obtener citas por paciente
    public function obtenerCitasPorPaciente($id_paciente) {
        $query = "SELECT c.*, m.nombre_completo as nombre_medico, e.nombre_especialidad
                FROM " . $this->table_name . " c
                INNER JOIN medicos m ON c.id_medico = m.id_medico
                INNER JOIN especialidades e ON m.id_especialidad = e.id_especialidad
                WHERE c.id_paciente = :id_paciente
                ORDER BY c.fecha_cita DESC, c.hora_cita DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_paciente", $id_paciente);
        $stmt->execute();
        
        return $stmt;
    }

    // Obtener citas por médico
    public function obtenerCitasPorMedico($id_medico, $fecha = null) {
        $query = "SELECT c.*, p.nombre_completo as nombre_paciente, p.dui
                FROM " . $this->table_name . " c
                INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                WHERE c.id_medico = :id_medico";

        if($fecha) {
            $query .= " AND c.fecha_cita = :fecha_cita";
        }

        $query .= " ORDER BY c.fecha_cita ASC, c.hora_cita ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_medico", $id_medico);
        
        if($fecha) {
            $stmt->bindParam(":fecha_cita", $fecha);
        }

        $stmt->execute();
        
        return $stmt;
    }
}