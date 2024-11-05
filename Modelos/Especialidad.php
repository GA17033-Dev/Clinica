<?php
require_once 'config/database.php';

class Especialidad {
    private $conn;
    private $table_name = "especialidades";


    public $id_especialidad;
    public $nombre_especialidad;
    public $descripcion;
    public $estado;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                (nombre_especialidad, descripcion) 
                VALUES (:nombre_especialidad, :descripcion)";

        $stmt = $this->conn->prepare($query);

        $this->nombre_especialidad = htmlspecialchars(strip_tags($this->nombre_especialidad));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));

    
        $stmt->bindParam(":nombre_especialidad", $this->nombre_especialidad);
        $stmt->bindParam(":descripcion", $this->descripcion);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " 
                WHERE estado = 1 
                ORDER BY nombre_especialidad";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " 
                WHERE id_especialidad = ? AND estado = 1 
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_especialidad);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre_especialidad = $row['nombre_especialidad'];
            $this->descripcion = $row['descripcion'];
            return true;
        }
        return false;
    }
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                SET nombre_especialidad = :nombre_especialidad,
                    descripcion = :descripcion
                WHERE id_especialidad = :id_especialidad";

        $stmt = $this->conn->prepare($query);

        $this->nombre_especialidad = htmlspecialchars(strip_tags($this->nombre_especialidad));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));

        // Vincular valores
        $stmt->bindParam(":nombre_especialidad", $this->nombre_especialidad);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":id_especialidad", $this->id_especialidad);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {

        if($this->tieneMediacosAsociados()) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " 
                SET estado = 0 
                WHERE id_especialidad = :id_especialidad";
        
        $stmt = $this->conn->prepare($query);
        
        $this->id_especialidad = htmlspecialchars(strip_tags($this->id_especialidad));
        $stmt->bindParam(":id_especialidad", $this->id_especialidad);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function existeNombre($nombre, $excluir_id = null) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                WHERE nombre_especialidad = ? AND estado = 1" . 
                ($excluir_id ? " AND id_especialidad != ?" : "");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre);
        if($excluir_id) {
            $stmt->bindParam(2, $excluir_id);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'] > 0;
    }
    private function tieneMediacosAsociados() {
        $query = "SELECT COUNT(*) as count FROM medicos 
                WHERE id_especialidad = ? AND estado = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_especialidad);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'] > 0;
    }
}