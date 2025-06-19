<?php
// models/ObjetoModel.php

require_once 'Database.php';

class Producto {
    // Atributos (propiedades del objeto)
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $categoria;
    public $fecha_creacion;
    public $fecha_actualizacion;
    public $activo;
    public $imagen_url;

    private $conn;
    private $table_name = "productos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método 1: CREATE - Crear un nuevo producto
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  (nombre, descripcion, precio, stock, categoria, activo, imagen_url)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Limpiar y enlazar valores
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->activo = htmlspecialchars(strip_tags($this->activo));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));

        // Enlazar parámetros (tipos: s=string, i=integer, d=double, b=blob)
        $stmt->bind_param("ssdissi",
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->stock,
            $this->categoria,
            $this->activo,
            $this->imagen_url
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método 2: READ - Leer todos los productos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_creacion DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    // Método 3: READ - Leer un solo producto por ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->precio = $row['precio'];
            $this->stock = $row['stock'];
            $this->categoria = $row['categoria'];
            $this->fecha_creacion = $row['fecha_creacion'];
            $this->fecha_actualizacion = $row['fecha_actualizacion'];
            $this->activo = $row['activo'];
            $this->imagen_url = $row['imagen_url'];
            return true;
        }
        return false;
    }

    // Método 4: UPDATE - Actualizar un producto existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                      nombre = ?,
                      descripcion = ?,
                      precio = ?,
                      stock = ?,
                      categoria = ?,
                      activo = ?,
                      imagen_url = ?
                  WHERE
                      id = ?";

        $stmt = $this->conn->prepare($query);

        // Limpiar y enlazar valores
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->activo = htmlspecialchars(strip_tags($this->activo));
        $this->imagen_url = htmlspecialchars(strip_tags($this->imagen_url));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Enlazar parámetros
        $stmt->bind_param("ssdisisi",
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->stock,
            $this->categoria,
            $this->activo,
            $this->imagen_url,
            $this->id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método 5: DELETE - Eliminar un producto
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>