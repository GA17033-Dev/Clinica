<?php
require_once 'config/database.php';

class Medico {
    private $conn;
    private $table_name = "medicos";


    public $id_medico;
    public $nombre_completo;
    public $numero_jvpm;
    public $telefono;
    public $correo;
    public $id_especialidad;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                (nombre_completo, numero_jvpm, telefono, correo, id_especialidad) 
                VALUES (:nombre_completo, :numero_jvpm, :telefono, :correo, :id_especialidad)";

        $stmt = $this->conn->prepare($query);


        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->numero_jvpm = htmlspecialchars(strip_tags($this->numero_jvpm));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));

        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":numero_jvpm", $this->numero_jvpm);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":id_especialidad", $this->id_especialidad);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function leer() {
        $query = "SELECT m.*, e.nombre_especialidad 
                FROM " . $this->table_name . " m 
                LEFT JOIN especialidades e ON m.id_especialidad = e.id_especialidad 
                WHERE m.estado = 1 
                ORDER BY m.nombre_completo";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

 
    public function leerUno() {
        $query = "SELECT m.*, e.nombre_especialidad 
                FROM " . $this->table_name . " m 
                LEFT JOIN especialidades e ON m.id_especialidad = e.id_especialidad 
                WHERE m.id_medico = ? AND m.estado = 1 
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_medico);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre_completo = $row['nombre_completo'];
            $this->numero_jvpm = $row['numero_jvpm'];
            $this->telefono = $row['telefono'];
            $this->correo = $row['correo'];
            $this->id_especialidad = $row['id_especialidad'];
            return true;
        }
        return false;
    }


    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                SET nombre_completo = :nombre_completo,
                    numero_jvpm = :numero_jvpm,
                    telefono = :telefono,
                    correo = :correo,
                    id_especialidad = :id_especialidad
                WHERE id_medico = :id_medico";

        $stmt = $this->conn->prepare($query);

        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->numero_jvpm = htmlspecialchars(strip_tags($this->numero_jvpm));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));
        $this->id_medico = htmlspecialchars(strip_tags($this->id_medico));

        // Vincular valores
        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":numero_jvpm", $this->numero_jvpm);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":id_especialidad", $this->id_especialidad);
        $stmt->bindParam(":id_medico", $this->id_medico);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function eliminar() {
        $query = "UPDATE " . $this->table_name . " SET estado = 0 WHERE id_medico = :id_medico";
        $stmt = $this->conn->prepare($query);
        
        $this->id_medico = htmlspecialchars(strip_tags($this->id_medico));
        $stmt->bindParam(":id_medico", $this->id_medico);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function existeJVPM($numero_jvpm, $excluir_id = null) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                WHERE numero_jvpm = ? AND estado = 1" . 
                ($excluir_id ? " AND id_medico != ?" : "");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $numero_jvpm);
        if($excluir_id) {
            $stmt->bindParam(2, $excluir_id);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'] > 0;
    }

    public function obtenerPorEspecialidad($id_especialidad) {
        $query = "SELECT * FROM " . $this->table_name . " 
                WHERE id_especialidad = ? AND estado = 1 
                ORDER BY nombre_completo";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_especialidad);
        $stmt->execute();
        
        return $stmt;
    }
}