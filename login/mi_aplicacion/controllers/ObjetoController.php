<?php
// controllers/ObjetoController.php

require_once 'C:\xampp\htdocs\login\mi_aplicacion\controllers\ObjetoController.php';

class ProductoController {
    private $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    // Muestra la lista de productos
    public function index() {
        $stmt = $this->producto->read();
        $num = $stmt->num_rows; // Número de registros
        include 'C:\xampp\htdocs\login\mi_aplicacion\views\index.php'; // Incluye la vista principal
    }

    // Muestra el formulario para crear un nuevo producto
    public function createForm() {
        include 'C:\xampp\htdocs\login\mi_aplicacion\views\form.php';
    }

    // Procesa la creación de un nuevo producto
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->producto->nombre = $_POST['nombre'] ?? '';
            $this->producto->descripcion = $_POST['descripcion'] ?? '';
            $this->producto->precio = $_POST['precio'] ?? 0.00;
            $this->producto->stock = $_POST['stock'] ?? 0;
            $this->producto->categoria = $_POST['categoria'] ?? '';
            $this->producto->activo = isset($_POST['activo']) ? 1 : 0;
            $this->producto->imagen_url = $_POST['imagen_url'] ?? '';

            if ($this->producto->create()) {
                header("Location: ?action=index&message=Producto creado exitosamente.");
            } else {
                header("Location: ?action=createForm&error=No se pudo crear el producto.");
            }
            exit();
        }
    }

    // Muestra el formulario para editar un producto existente
    public function editForm() {
        $this->producto->id = $_GET['id'] ?? die('ID de producto no especificado.');
        if ($this->producto->readOne()) {
            // Los datos del producto están ahora en las propiedades del objeto $this->producto
            include 'C:\xampp\htdocs\login\mi_aplicacion\views\form.php';
        } else {
            header("Location: ?action=index&error=Producto no encontrado.");
            exit();
        }
    }

    // Procesa la actualización de un producto
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->producto->id = $_POST['id'] ?? die('ID de producto no especificado.');
            $this->producto->nombre = $_POST['nombre'] ?? '';
            $this->producto->descripcion = $_POST['descripcion'] ?? '';
            $this->producto->precio = $_POST['precio'] ?? 0.00;
            $this->producto->stock = $_POST['stock'] ?? 0;
            $this->producto->categoria = $_POST['categoria'] ?? '';
            $this->producto->activo = isset($_POST['activo']) ? 1 : 0;
            $this->producto->imagen_url = $_POST['imagen_url'] ?? '';

            if ($this->producto->update()) {
                header("Location: ?action=index&message=Producto actualizado exitosamente.");
            } else {
                header("Location: ?action=editForm&id=" . $this->producto->id . "&error=No se pudo actualizar el producto.");
            }
            exit();
        }
    }

    // Procesa la eliminación de un producto
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if ($this->producto->delete()) {
                header("Location: ?action=index&message=Producto eliminado exitosamente.");
            } else {
                header("Location: ?action=index&error=No se pudo eliminar el producto.");
            }
            exit();
        }
    }
}
?>