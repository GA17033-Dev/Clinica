<?php
require_once 'config/Database.php';

class Paciente {
    private $conn;
    private $table_name = "pacientes";
    public $id_paciente;
    public $nombre_completo;
    public $fecha_nacimiento;
    public $dui;
    public $telefono;
    public $correo;
    public $direccion;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                (nombre_completo, fecha_nacimiento, dui, telefono, correo, direccion) 
                VALUES (:nombre_completo, :fecha_nacimiento, :dui, :telefono, :correo, :direccion)";

        $stmt = $this->conn->prepare($query);

        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->dui = htmlspecialchars(strip_tags($this->dui));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));

        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":dui", $this->dui);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":direccion", $this->direccion);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE estado = 1 ORDER BY nombre_completo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_paciente = ? AND estado = 1 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_paciente);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre_completo = $row['nombre_completo'];
            $this->fecha_nacimiento = $row['fecha_nacimiento'];
            $this->dui = $row['dui'];
            $this->telefono = $row['telefono'];
            $this->correo = $row['correo'];
            $this->direccion = $row['direccion'];
            return true;
        }
        return false;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                SET nombre_completo = :nombre_completo,
                    fecha_nacimiento = :fecha_nacimiento,
                    dui = :dui,
                    telefono = :telefono,
                    correo = :correo,
                    direccion = :direccion
                WHERE id_paciente = :id_paciente";

        $stmt = $this->conn->prepare($query);

        $this->nombre_completo = htmlspecialchars(strip_tags($this->nombre_completo));
        $this->fecha_nacimiento = htmlspecialchars(strip_tags($this->fecha_nacimiento));
        $this->dui = htmlspecialchars(strip_tags($this->dui));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->id_paciente = htmlspecialchars(strip_tags($this->id_paciente));

        $stmt->bindParam(":nombre_completo", $this->nombre_completo);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":dui", $this->dui);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":id_paciente", $this->id_paciente);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {
        $query = "UPDATE " . $this->table_name . " SET estado = 0 WHERE id_paciente = :id_paciente";
        $stmt = $this->conn->prepare($query);
        
        $this->id_paciente = htmlspecialchars(strip_tags($this->id_paciente));
        $stmt->bindParam(":id_paciente", $this->id_paciente);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function existeDui($dui, $excluir_id = null) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                WHERE dui = ? AND estado = 1" . 
                ($excluir_id ? " AND id_paciente != ?" : "");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $dui);
        if($excluir_id) {
            $stmt->bindParam(2, $excluir_id);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'] > 0;
    }
}