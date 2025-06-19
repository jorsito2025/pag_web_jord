<?php
// models/Database.php

class Database {
    private $host = "localhost"; // Tu host de MySQL (normalmente localhost)
    private $user = "root";      // Tu usuario de MySQL (por defecto root en XAMPP)
    private $pass = "";          // Tu contraseña de MySQL (por defecto vacía en XAMPP)
    private $db_name = "mi_aplicacion_db"; // Nombre de tu base de datos
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

        if ($this->conn->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8"); // Asegura que los caracteres se manejen correctamente
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>