<?php
// mi_aplicacion/index.php (El punto de entrada principal)

// PRIMERO CARGA EL MODELO, porque el controlador lo necesita
require_once 'C:\xampp\htdocs\login\mi_aplicacion\models\ObjetoModel.php'; // <--- CAMBIO AQUÍ: La ruta es relativa a index.php

// LUEGO CARGA EL CONTROLADOR
require_once 'C:\xampp\htdocs\login\mi_aplicacion\controllers\ObjetoController.php';


// Crear una instancia del controlador
$controller = new ProductoController();

// Determinar la acción a realizar
$action = $_GET['action'] ?? 'index'; // Por defecto, mostrar la lista de productos

// Enrutador simple
switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'createForm':
        $controller->createForm();
        break;
    case 'create':
        $controller->create();
        break;
    case 'editForm':
        $controller->editForm();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        // Manejar acción no encontrada o página 404
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Página no encontrada</h1>";
        exit();
}
?>